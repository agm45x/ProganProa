<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si ya tiene sesión activa, redirigir según su rol
if (!empty($_SESSION['user_id'])) {
    $role = strtolower($_SESSION['role'] ?? 'viewer');
    switch ($role) {
        case 'viewer':
            header('Location: /visorintegral.php');
            break;
        case 'analyst':
            header('Location: /Financiera.html');
            break;
        case 'gerenteg4':
            header('Location: /GerenteG4.php');
            break;
        case 'gerenteprogan':
            header('Location: /Gerenteprogan.php');
            break;
        case 'gerentecargapro':
            header('Location: /Gerentecargapro.php');
            break;
        default:
            header('Location: /visorintegral.php');
            break;
    }
    exit;
}

// Prevenir caché del navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

// Mostrar mensajes de error o éxito
$error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';
$show_register = $_SESSION['show_register'] ?? false;

// Limpiar mensajes después de mostrarlos
unset($_SESSION['error'], $_SESSION['success'], $_SESSION['show_register']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login / Registro - PROA</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <div class="wrap">
    <h2 id="title"><?= $show_register ? 'Crear cuenta' : 'Iniciar sesión' ?></h2>
    <p class="muted" id="subtitle">
      <?= $show_register ? 'Completa tus datos para registrarte.' : 'Ingresa tus credenciales para continuar.' ?>
    </p>

    <!-- Mensajes de error/éxito -->
    <?php if ($error): ?>
      <div id="alert" class="err" style="display:block;">
        ⚠️ <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div id="alert" class="ok" style="display:block;">
        ✅ <?= htmlspecialchars($success) ?>
      </div>
    <?php endif; ?>

    <!-- LOGIN -->
    <form id="form-login" class="<?= !$show_register ? 'active' : '' ?>" action="login.php" method="post">
      <div class="input-box">
        <i class="fa-solid fa-user icon"></i>
        <input type="text" name="username" required placeholder="Usuario o correo">
      </div>

      <div class="input-box">
        <i class="fa-solid fa-lock icon"></i>
        <input type="password" name="password" required placeholder="Contraseña">
      </div>

      <button type="submit"><i class="fa-solid fa-right-to-bracket"></i> LOGIN</button>
    </form>

    <!-- REGISTRO -->
    <form id="form-register" class="<?= $show_register ? 'active' : '' ?>" action="registro.php" method="post">
      <label>Usuario</label>
      <input type="text" name="username" required placeholder="elige un usuario">

      <label>Correo</label>
      <input type="email" name="email" required placeholder="tu@correo.com">

      <label>Contraseña</label>
      <input type="password" name="password" required placeholder="crea una contraseña">

      <button type="submit">Crear cuenta</button>
    </form>

    <div class="toggle">
      <?php if (!$show_register): ?>
        <a href="?register=1">¿No tienes cuenta? Regístrate</a>
      <?php else: ?>
        <a href="/">¿Ya tienes cuenta? Inicia sesión</a>
      <?php endif; ?>
    </div>
  </div>

  <?php if (isset($_GET['register'])): ?>
  <script>
    // Solo para cambiar vista sin recargar (opcional)
    document.getElementById('form-login').classList.remove('active');
    document.getElementById('form-register').classList.add('active');
    document.getElementById('title').textContent = 'Crear cuenta';
    document.getElementById('subtitle').textContent = 'Completa tus datos para registrarte.';
  </script>
  <?php endif; ?>
</body>

</html>