<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use OpenAI;
use App\Models\Product;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Parameter;

class ChatController extends Controller
{
    public function ask(Request $request){

        $userMessage = $request->input('message');

        if(!$userMessage){
            return response()->json(['response'=>'Por favor, escribe una pregunta.']);
        }

        try{
            $client = OpenAI::client(Parameter::getValue('OPENAI_API_KEY'));

            // **Obtenemos o creamos el chat con los datos en duro**
            $chat = Chat::firstOrCreate(
                ['whatsapp_number' => '5493534191741'],
                ['name' => 'Gustavo Pruebas'],
            );

            // **Guardamos el mensaje del usuario**
            ChatMessage::create([
                'chat_id' => $chat->id,
                'message' => $userMessage,
                'sender' => 'user',
            ]);

            $promt = "
                Actúas como un asistente de ventas para la tienda en línea de Andercode.
                Solo generarás consultas en Laravel Eloquent usando el namespace completo `App\Models\Product`.

                📌 **Estructura de la tabla `products`:**
                - `        `volumen_carga_m3`,
            `potencia_requerida_hp`,
            `toma_potencia_tom`,
            `tiempo_descarga_aprx_min`,
            `balanza`,
            `camaras`,
            `altura_maxima_mm`,
            `altura_carga_mm`,
            `longitud_total_mm`,
            `peso_vacio_kg`,
            `de_serie`,
            `opcional`,
            `colores`


                🔹 **Ejemplo de preguntas y consultas correctas en Laravel:**
                - ❓ ¿Cuántos productos hay en stock?
                  ✅ `App\Models\Product::sum('stock');`

                - ❓ ¿Cuánto cuesta el iPhone 14 Pro Max?
                  ✅ `App\Models\Product::where('name', 'iPhone 14 Pro Max')->value('price');`

                - ❓ ¿Cuáles son los productos en oferta?
                  ✅ `App\Models\Product::whereNotNull('discount_price')->get(['name', 'discount_price']);`

                - ❓ ¿Qué categorías de productos hay?
                  ✅ `App\Models\Product::distinct()->pluck('category');`

                - ❓ ¿Cuál es el precio con descuento del producto 'Sed Cum Debitis'?
                  ✅ `App\Models\Product::where('name', 'Sed Cum Debitis')->value('discount_price');`

                **Devuelve SOLO la consulta en una línea de código Laravel Eloquent, sin explicaciones, sin comentarios, sin etiquetas de código como `plaintext`, `php` o ```**.

                Pregunta del usuario: $userMessage
            ";

            // **Enviar la consulta a OPENAI**
            $response = $client->chat()->create([
                'model' => 'gpt-4-turbo',
                'messages' => [['role' => 'system' , 'content' => $promt]],
                'max_tokens' => 100,
            ]);

            // **Obtener la respuesta del asistente correctamente**
            $query = trim($response['choices'][0]['message']['content'] ?? '');

            $result = eval("return $query;");

            //Log::info("Consulta generada por OpenAI: $query" . $result);

            // **customlogger("info","Mensaje del usuario: ",['result' => $result]);**

            if (!$result) {
                $responseText = "No se encontraron resultados para la consulta.";
            } elseif(is_numeric($result)){
                $responseText = "El resultado es: $result.";
            } elseif(is_array($result) || is_object($result)){
                $responseText = "Aquí tienes los datos: \n\n" . json_encode($result, JSON_PRETTY_PRINT);
            } else {
                $responseText = "Aquí tienes la Información solicitada: $result.";
            }

            return response()->json(['response' => $responseText]);

        } catch (\Exception $e){
             return response()->json(['response'=>'Error al conectar con OpenIA:' . $e->getMessage()]);
        }
    }

    public function index(){
        $chats = Chat::orderBy('id','desc')->get();
        return view('chats.index', compact('chats'));
    }

    public function show($chatId){
        $chats = Chat::orderBy('id','desc')->get();
        $chat = Chat::findOrFail($chatId);
        $messages = ChatMessage::where('chat_id', $chat->id)->orderBy('created_at', 'asc')->get();

         return view('chats.index', compact('chats', 'chat', 'messages'));
    }

}
