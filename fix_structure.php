<?php
// fix_structure.php - Ejecutar UNA SOLA VEZ desde SSH: php fix_structure.php

echo "Reparando estructura de Laravel...\n";

// 1. Verificar si estamos en la raíz
if (!file_exists('composer.json') || !file_exists('artisan')) {
    echo "ERROR: No estás en la raíz de Laravel.\n";
    echo "Ejecuta: cd /home/tuusuario/public_html/cotizacion && php fix_structure.php\n";
    exit(1);
}

// 2. Verificar public/index.php
if (!file_exists('public/index.php')) {
    echo "Creando public/index.php...\n";
    copy('https://raw.githubusercontent.com/laravel/laravel/master/public/index.php', 'public/index.php');
}

// 3. Verificar .htaccess
$htaccess_content = '# LARAVEL - Configuración básica
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>';

file_put_contents('public/.htaccess', $htaccess_content);

// 4. Verificar permisos
chmod('public', 0755);
chmod('public/index.php', 0644);
chmod('public/.htaccess', 0644);
chmod('storage', 0755);
chmod('bootstrap/cache', 0755);

// 5. Crear enlace simbólico si es necesario
if (!file_exists('/home/tuusuario/public_html/public')) {
    symlink('/home/tuusuario/public_html/cotizacion/public', '/home/tuusuario/public_html/public');
}

echo "✅ Reparación completada.\n";
echo "Accede a: https://cotizacion.comofrasrl.com.ar/public/\n";
?>