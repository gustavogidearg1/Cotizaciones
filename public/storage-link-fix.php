<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

if (is_link($link) || file_exists($link)) {
    echo "⚠️ Ya existe algo llamado 'storage'. Eliminálo manualmente para continuar.";
} else {
    if (symlink($target, $link)) {
        echo "✅ Enlace simbólico creado correctamente: storage → $target";
    } else {
        echo "❌ No se pudo crear el symlink. Verificá permisos.";
    }
}
