<?php
// db.php
// Iniciar sesión solo si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = ''; // XAMPP por defecto
$DB_NAME = 'progan_analyst';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_error) {
  die('Error de conexión: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');