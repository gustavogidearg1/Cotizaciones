<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Parameter;
use Illuminate\Support\Facades\Http;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Http\Controllers\ChatController;

class WhatsAppWebhookController extends Controller
{
    public function verify(Request $request)
    {
        customlogger("info","Evento Whatsapp recibido", ['query' => $request->all()]);

        $verifyToken = Parameter::getValue('WHATSAPP_VERIFY_TOKEN'); 

        if ($request->input('hub_mode') === 'subscribe' && $request->input('hub_verify_token') === $verifyToken) {

            customlogger("info","WebHook Verificado Correctamente: ","");
            return response($request->input('hub_challenge'), 200);
        }

        customlogger("error","Fallo la verificación","");
        return response('No autorizado', 403);
    }

    // ** Recibir y procesar mensajes de WhatsApp **
    public function receive(Request $request){
        try{
            // **Guardar el evento recibido en logs**
            customlogger("info","Evento Whatsapp recibido",['receive' => $request->all()]);

            // **Verificar si el evento contiene mensaje**
            if(!isset($request['entry'][0]['changes'][0]['value']['messages'])){
                return response()->json(['message'=>'No hay mensajes.'], 200);
            }

            $messageData = $request['entry'][0]['changes'][0]['value']['messages'][0] ?? null;
            $userMessage = $messageData['text']['body'] ?? '';
            $whatsappNumber = $request['entry'][0]['changes'][0]['value']['contacts'][0]['wa_id'] ?? null;
            $userName = $request['entry'][0]['changes'][0]['value']['contacts'][0]['profile']['name'] ?? 'Usuario WhatsApp';

            // **Verificar datos esenciales si existen**
            if (!$whatsappNumber || !$userMessage){
                customlogger("error","Error en los datos recibidos","");
                return response()->json(['message'=>'Error en los datos recibidos'], 400);
            }

            // **Guardamos la cabezera**
            $chat = Chat::firstOrCreate(
                ['whatsapp_number' => $whatsappNumber],
                ['name' => $userName],
            );

            // **Guardamos el mensaje del usuario**
            ChatMessage::create([
                'chat_id' => $chat->id,
                'message' => $userMessage,
                'sender' => 'user',
            ]);

            $botResponse = $this->getBotResponse($userMessage);

            // **Guardamos la respuesta del bot**
            ChatMessage::create([
                'chat_id' => $chat->id,
                'message' => $botResponse,
                'sender' => 'bot',
            ]);

            $this->sendWhatsAppMessage($whatsappNumber,$botResponse);

            return response()->json(['message'=>'Mensaje Procesado'], 200);

        }catch(\Exception $e){
            customlogger("error","Error en la Recepción del Mensaje",['exception' => $e->getMessage()]);
            return response()->json(['message'=>'Error interno del Servidor.'], 500);
        }
    }

    private function getBotResponse($userMessage){
        try{
            $chatController = new ChatController();
            $request = new Request(['message' => $userMessage]);
            $response = $chatController->ask($request);

            $botResponse = json_decode($response->getContent(),true)['response'] ?? 'No tengo una respuesta en este momento.';

            return $botResponse;
        } catch(\Exception $e){
            customlogger("error","Problemas con la respuesta del Bot",['exception' => $e->getMessage()]);
        }
    }

    private function sendWhatsAppMessage($to, $message){
        try{
            $accessToken = Parameter::getValue('WHATSAPP_ACCESS_TOKEN');
            $phoneNumberId = Parameter::getValue('WHATSAPP_PHONE_ID'); // Número de WhatsApp en Meta

            $url = "https://graph.facebook.com/v22.0/{$phoneNumberId}/messages";

            $data = [
                "messaging_product" => "whatsapp",
                "recipient_type"=> "individual",
                "to" => $to,
                "type" => "text",
                "text" => ["body" => $message],
            ];

            $headers = [
                "Authorization: Bearer $accessToken",
                "Content-Type: application/json"
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            curl_close($ch);

        }catch(\Exception $e){
            customlogger("error","Error al enviar el mensaje a WhatsApp API",['exception' => $e->getMessage()]);
        }
    }
}
