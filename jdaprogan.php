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
  <title>INFORME FINANCIERO PROGAN DEL CARIBE</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body class="bi-page">
  <a href="javascript:history.back()" class="btn-volver">
  <i class="fas fa-arrow-left"></i> Regresar
  </a>
  <!-- Usuario -->
  <div class="user-info2">
    <i class="fa-solid fa-user-circle"></i>
    <span><?php echo htmlspecialchars($user); ?></span>
    <a href="logout.php" class="logout-btn">
      <i class="fa-solid fa-right-from-bracket"></i>
    </a>
  </div>

  <!-- Contenedor principal del tablero -->
  <section class="bi-container">
    <h1 class="bi-title">INFORME FINANCIERO PROGAN DEL CARIBE</h1>

    <!-- Aquí colocas el iframe del Power BI -->
    <div class="bi-frame-wrapper">
      <iframe 
        title="Informe Financiero JDA"
        width="100%"
        height="775"
        src="https://app.powerbi.com/view?r=eyJrIjoiODRiZGMxMDYtMGRhNS00YzM3LTk1NmUtOTUyNmNiY2Y5MjM0IiwidCI6IjM3YzA2NzQ2LTdjNmItNDNhYy1iNGNkLWRmZmU5NmFmNjZkZCIsImMiOjR9"
        frameborder="0"
        allowFullScreen="true">
      </iframe>
    </div>
  </section>

  <footer>
    &copy; <?php echo date("Y"); ?> PROA. Todos los derechos reservados.
  </footer>

</body>
</html>
