<?php
$host = '127.0.0.1'; // o prueba con 'localhost' si falla
$db   = 'comofras_bd_cotizacion';
$user = 'comofras_cotizacion';
$pass = 'Comofra05!';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    echo "✅ Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage();
}
?>
