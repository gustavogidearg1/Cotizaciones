<?php

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(__DIR__ . '/../', RecursiveDirectoryIterator::SKIP_DOTS)
);

foreach ($files as $file) {
    if ($file->isFile() && in_array($file->getExtension(), ['php', 'json'])) {
        $contents = file_get_contents($file->getRealPath());
        if (strpos($contents, 'Laravel\\Pail\\PailServiceProvider') !== false) {
            echo "🔍 Encontrado en: " . $file->getRealPath() . "<br>";
        }
    }
}
