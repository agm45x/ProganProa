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
  <title>cargapro</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body class="Gerentes1">

  <!-- Botón volver -->
  <a href="javascript:history.back()" class="volverG">
    <i class="fas fa-arrow-left"></i> Regresar
  </a>

  <!-- Barra superior 
  <header class="topbar">
    <div class="logo-texto">
      <span class="texto-principal">PROA</span>
      <span class="separador">|</span>
      <img src="imagenes/Logo Progan.png" alt="Logo Progan" class="logo">
    </div>
  </header>-->
<!-- Contenido superior con fondo normal -->
<div class="user-info2">
  <i class="fa-solid fa-user-circle"></i>
  <span><?php echo htmlspecialchars($user); ?></span>
  <a href="logout.php" class="logout-btn">
    <i class="fa-solid fa-right-from-bracket"></i>
  </a>
</div>

<!-- Espaciador simple -->
<div class="espaciador"></div>

<!-- === Sección con fondo negro === -->
<section class="bi-container1">
  <h2 class="bi-title1">INFORME OPERATIVO CARGAPRO</h2>
  <div class="bi-frame-wrapper1">
    <iframe 
      title="INFORME OPERATIVO CARGAPRO"
      width="100%"
      height="775"
      src="https://app.powerbi.com/view?r=eyJrIjoiNWMwMDIzODYtNjY1Yy00NjhhLTllMjQtYjgyMTFlZjI2OWEwIiwidCI6IjM3YzA2NzQ2LTdjNmItNDNhYy1iNGNkLWRmZmU5NmFmNjZkZCIsImMiOjR9"
      frameborder="0"
      allowFullScreen="true">
    </iframe>
  </div>
</section>

  <!-- Footer -->
  <footer class="footerbig">
    &copy; <?php echo date("Y"); ?> PROA. Todos los derechos reservados.
  </footer>

</body>
</html>
