<?php

// Mostrar errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

if (is_link($link) || file_exists($link)) {
    echo "⚠️ Ya existe el enlace simbólico o carpeta: <code>$link</code><br>";
} else {
    if (symlink($target, $link)) {
        echo "✅ Enlace simbólico creado correctamente.<br>";
        echo "➡️ <code>$link → $target</code>";
    } else {
        echo "❌ Error al crear el enlace simbólico.<br>";
        echo "Verificá permisos del servidor.";
    }
}
