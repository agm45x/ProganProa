<?php
// logout.php - Cierre de sesión seguro
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Prevenir caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

// Destruir todas las variables de sesión
$_SESSION = array();

// Borrar la cookie de sesión si existe
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Destruir la sesión
session_destroy();

// Mensaje de confirmación
session_start(); // Reiniciar para el mensaje
$_SESSION['success'] = 'Has cerrado sesión correctamente';

// Redirigir al login
header("Location: /");
exit;