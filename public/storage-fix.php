<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$source = realpath(__DIR__ . '/../storage/app/public');
$destination = __DIR__ . '/storage';

function copyRecursive($source, $destination)
{
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }

    $dir = opendir($source);
    while (($file = readdir($dir)) !== false) {
        if ($file === '.' || $file === '..') continue;

        $srcPath = $source . DIRECTORY_SEPARATOR . $file;
        $destPath = $destination . DIRECTORY_SEPARATOR . $file;

        if (is_dir($srcPath)) {
            copyRecursive($srcPath, $destPath);
        } else {
            copy($srcPath, $destPath);
        }
    }
    closedir($dir);
}

if (!file_exists($source)) {
    echo "❌ La carpeta de origen no existe: <code>$source</code>";
    exit;
}

copyRecursive($source, $destination);
echo "✅ Archivos copiados desde <code>$source</code> a <code>$destination</code><br>";
echo "ℹ️ Ahora deberías poder ver las imágenes en <code>/storage/</code> desde el navegador.";
