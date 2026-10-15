<?php

use App\Models\Log;

/**
 * Función para registrar logs personalizados en la base de datos.
 *
 * @param string $info - Tipo de log (ejemplo: "Consulta de OpenAI")
 * @param string $message - Descripción detallada del evento
 * @param string $context - Información adicional del contexto
 */
function customlogger($info, $message, $context=[])
{
    $contexjson = !empty($context)? json_decode($context):null;
    Log::create([
        'info' => $info,
        'message' => $message,
        'context' => $contexjson,
    ]);
}
