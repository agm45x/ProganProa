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

// ✅ AGREGA ESTAS LÍNEAS PARA DEFINIR LAS VARIABLES DEL USUARIO
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
  <title>Visor Integral - PROA</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body class="visor-page">
  <a href="javascript:history.back()" class="btn-volver">
  <i class="fas fa-arrow-left"></i> Regresar
  </a>

  <!-- Barra superior -->
  <header class="topbar">
    <img src="imagenes/Logo.jpg" alt="Logo Progan">
  </header>

  <!-- Usuario logueado -->
  <div class="user-info">
    <i class="fa-solid fa-user-circle"></i>
    <span><?php echo htmlspecialchars($user); ?></span>
    <a href="logout.php" class="logout-btn">
      <i class="fa-solid fa-right-from-bracket"></i>
    </a>
  </div>

  <!-- Contenido central -->
<h1 class="welcome-title">BIENVENIDO A <b>PROA</b></h1>
<p class="texto">
  Portal de indicadores estratégicos del Grupo Progan.
</p>

<!-- CONTENEDOR DE BOTONES DE IMAGEN -->
<div class="button-row">

  <div class="button-item">
    <a href="progan.php" class="img-circle">
      <img src="imagenes/progan.jpg" alt="Progan">
    </a>
    <p>Nutrición animal</p>
  </div>

  <div class="button-item">
    <a href="cargapro.php" class="img-circle">
      <img src="imagenes/cargapro.jpg" alt="CargaPro">
    </a>
    <p>Transporte terrestre</p>
  </div>

  <div class="button-item">
    <a href="g4.php" class="img-circle">
      <img src="imagenes/g4.png" alt="G4 Services">
    </a>
    <p>Logística integral</p>
  </div>

  <div class="button-item">
    <a href="ci.php" class="img-circle">
      <img src="imagenes/ci.jpg" alt="CI">
    </a>
    <p>Feedstock</p>
  </div>

  <div class="button-item">
    <a href="acerum.php" class="img-circle">
      <img src="imagenes/acerum.png" alt="ACERUM">
    </a>
    <b> </b>
    <b></b>
    <p>Acerum</p>
  </div>
  
     <div class="button-item">
    <a href="inverde.php" class="img-circle">
      <img src="imagenes/inverde.png" alt="INVERDE">
    </a>
    <p>inverde</p>
  </div>

</div>


<p class="welcome-subtext">
  Los datos pueden mostrar retos o logros; tu visión es lo que transforma ambos en estrategia.
</p>


  <footer>
    &copy; <?php echo date("Y"); ?> PROA. Todos los derechos reservados.
  </footer>

</body>
</html>
