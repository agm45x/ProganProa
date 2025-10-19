<?php
// Coloca esto al INICIO de CADA página protegida (visorintegral.php, GerenteG4.php, etc.)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Prevenir acceso si no hay sesión
if (empty($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}

// Prevenir caché del navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'] ?? 'Usuario';
$user_role = $_SESSION['role'] ?? 'viewer';
$user = $username; // Variable que estabas usando
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>C.I PROGAN</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body class="ci">
  <a href="javascript:history.back()" class="btn-volver">
  <i class="fas fa-arrow-left"></i> Regresar
  </a>
<!-- 🔹 Barra superior -->
<header class="topbar">
  <div class="logo-texto">
    <span class="texto-principal">PROA</span>
    <span class="separador">|</span>
    <img src="imagenes/Logo CI Progan.png" alt="Logo CI Progan" class="logo-progan">
  </div>
</header>


  <!-- Usuario logueado -->
  <div class="user-info2">
    <i class="fa-solid fa-user-circle"></i>
    <span><?php echo htmlspecialchars($user); ?></span>
    <a href="logout.php" class="logout-btn">
      <i class="fa-solid fa-right-from-bracket"></i>
    </a>
  </div>


 <!-- Eslogan -->
<div class="recuadro-textoci">
  <div>
    <p class="linea-1">Aquí los datos revelan el rumbo.</p>
    <p class="linea-2">Positivos o desafiantes,</p>
    <p class="linea-3">siempre son la base para construir estrategia y avanzar.</p>
  </div>
</div>



<!-- ===== CONTENEDOR GENERAL DE BOTONES ===== -->
    <div class="menu-circular">
    </div>
    <section class="menu-botones">
    <a href="#" class="img-circle">
    <img src="imagenes/Boton Visor.png" alt="operativocargapro">
    </a>
    <a href="#" class="img-circle">
    <img src="imagenes/Boton Operaciones.png" alt="operativocargapro">
    </a>
    <a href="#" class="img-circle">
    <img src="imagenes/Boton Manto.png" alt="mantenimientocargapro">
  </a>
  </div>

 <!--<footer>
    &copy; <?php echo date("Y"); ?> PROA. Todos los derechos reservados.
  </footer>-->

</body>
</html>
