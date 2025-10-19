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
  <title>Progan</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body class="Gerentes">

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

<div class="contenedor">
  <div class="bloque">
    <div class="recuadro-texto">
      <p class="linea1">Aquí los datos revelan el rumbo.</p>
      <p class="linea2"><strong>Positivos o desafiantes,</strong></p>
      <p class="linea3">siempre son la base para construir</p>
      <p class="linea4">estrategia y avanzar.</p>
    </div>
    <img src="imagenes/Animales Progan.png" alt="Animales Progan" class="imagen-animales">
  </div>
</div>

<!-- === Sección con fondo negro === -->
<section class="bi-container1">
  <h2 class="bi-title1">INFORME OPERATIVO PROGAN DEL CARIBE</h2>
  
  <div class="bi-frame-wrapper1">
    <iframe 
      title="INFORME OPERATIVO PROGAN DEL CARIBE"
      width="100%"
      height="775"
      src="https://app.powerbi.com/view?r=eyJrIjoiM2FlMzhhMTMtOWU0Mi00NzBjLWI3NGItNmJmYmYxYzkyMTZlIiwidCI6IjM3YzA2NzQ2LTdjNmItNDNhYy1iNGNkLWRmZmU5NmFmNjZkZCIsImMiOjR9"
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
