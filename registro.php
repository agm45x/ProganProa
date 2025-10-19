<?php
// registro.php - versión sin JSON, con redirecciones tradicionales
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $_SESSION['error'] = 'Método no permitido';
  header('Location: /');
  exit;
}

$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $email === '' || $password === '') {
  $_SESSION['error'] = 'Todos los campos son requeridos';
  $_SESSION['show_register'] = true;
  header('Location: /');
  exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['error'] = 'Correo inválido';
  $_SESSION['show_register'] = true;
  header('Location: /');
  exit;
}

// ¿Usuario o correo ya existe?
$stmt = $mysqli->prepare('SELECT id FROM users WHERE username=? OR email=? LIMIT 1');
$stmt->bind_param('ss', $username, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  $stmt->close();
  $_SESSION['error'] = 'Usuario o correo ya existe';
  $_SESSION['show_register'] = true;
  header('Location: /');
  exit;
}
$stmt->close();

$hash = password_hash($password, PASSWORD_DEFAULT);
$role = 'viewer';

$stmt = $mysqli->prepare('INSERT INTO users (username,email,password_hash,role) VALUES (?,?,?,?)');
$stmt->bind_param('ssss', $username, $email, $hash, $role);

if ($stmt->execute()) {
  $stmt->close();
  
  // ✅ Registro exitoso - mostrar mensaje y volver al login
  $_SESSION['success'] = 'Usuario creado correctamente. Ahora inicia sesión para continuar.';
  header('Location: /');
  exit;
} else {
  $stmt->close();
  $_SESSION['error'] = 'No se pudo crear el usuario';
  $_SESSION['show_register'] = true;
  header('Location: /');
  exit;
}