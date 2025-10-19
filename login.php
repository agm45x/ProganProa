<?php
// login.php - versión sin JSON, con redirecciones tradicionales
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

$identifier = trim($_POST['username'] ?? '');
$password   = $_POST['password'] ?? '';

if ($identifier === '' || $password === '') {
  $_SESSION['error'] = 'Campos requeridos';
  header('Location: /');
  exit;
}

$stmt = $mysqli->prepare('SELECT id, username, email, password_hash, role, is_active
                          FROM users
                          WHERE (username=? OR email=?)
                          LIMIT 1');
$stmt->bind_param('ss', $identifier, $identifier);
$stmt->execute();
$res  = $stmt->get_result();
$user = $res->fetch_assoc();
$stmt->close();

if (!$user || !(int)$user['is_active']) {
  $_SESSION['error'] = 'Usuario no existe o está inactivo';
  header('Location: /');
  exit;
}

if (!password_verify($password, $user['password_hash'])) {
  $_SESSION['error'] = 'Credenciales inválidas';
  header('Location: /');
  exit;
}

// ✅ Login exitoso - establecer sesión
$_SESSION['user_id']  = (int)$user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role']     = $user['role'];

// Redirección por rol
$redirect = '/visorintegral.php'; // fallback

switch (strtolower($_SESSION['role'])) {
  case 'viewer':
    $redirect = '/visorintegral.php';
    break;

  case 'analyst':
    $redirect = '/Financiera.html';
    break;

  case 'gerenteg4':
    $redirect = '/GerenteG4.php';
    break;
    
  case 'gerenteprogan':
    $redirect = '/Gerenteprogan.php';
    break;
    
  case 'gerentecargapro':
    $redirect = '/Gerentecargapro.php';
    break;

  case 'admin':
  default:
    $redirect = '/visorintegral.php';
    break;
}

header('Location: ' . $redirect);
exit;