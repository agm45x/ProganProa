<?php
file_put_contents(__DIR__.'/guard.log', date('c')." ".$_SERVER['REQUEST_URI']."\n", FILE_APPEND);
// guard.php – se ejecuta antes de cualquier página (auto_prepend)
// Modo estricto para ver fallos en desarrollo:
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1) Deja pasar archivos estáticos (css, js, imágenes, fuentes, maps)
$ext = strtolower(pathinfo(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), PATHINFO_EXTENSION));
if (in_array($ext, ['css','js','png','jpg','jpeg','gif','svg','webp','ico','woff','woff2','ttf','eot','map'])) {
  return; // no hacemos checks para estáticos
}

// 2) Rutas/páginas públicas (sin login)
$public = [
  '/dashboard',
  '/',               // tu landing
  '/index.php',
  '/index.html',
  '/login.php',      // endpoints
  '/registro.php',
  '/favicon.ico',
  '/logout.php',
];

// 3) Normaliza ruta pedida
$uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = strtolower($uri);
$base = strtolower(basename($path));

// helper para comprobar si $uri está en $public (case-insensitive)
function in_public($uri, $public){
  $uri = strtolower(rtrim($uri,'/'));
  foreach ($public as $p){
    if ($uri === strtolower(rtrim($p,'/'))) return true;
  }
  return false;
}

// 4) Si es pública, permitir
if (in_public($uri, $public)) {
  return;
}

// ===== PREVENIR CACHÉ EN PÁGINAS PROTEGIDAS =====
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

// 5) Si no hay sesión, pedir login
if (empty($_SESSION['user_id'])) {
  header('Location: /');
  exit;
}

// 6) Control por rol
$role = $_SESSION['role'] ?? 'viewer';

// === Rol Visorintegral: puede ver todo excepto ciertas páginas ===
if ($role === 'Visorintegral') {
  $restrictedPages = [
    'admin_roles.php',
    'actualizar_rol.php',
  ];

  if (in_array($base, array_map('strtolower', $restrictedPages))) {
    http_response_code(403);
    echo '<!doctype html><meta charset="utf-8"><style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#0b1a14;color:#e6fff2;padding:40px}
    .box{max-width:720px;margin:0 auto;background:#11261d66;border:1px solid #2c5a49;border-radius:12px;padding:22px}
    a{color:#7de0ab;text-decoration:none}
    </style><div class="box"><h2>Acceso restringido</h2>
    <p>No tienes permisos para ver esta página.</p>
    <p><a href="/">Volver al inicio</a> · <a href="/logout.php">Cerrar sesión</a></p></div>';
    exit;
  }

  // Si no está restringida, permitir
  return;
}

// --- CONFIGURA AQUÍ TUS PERMISOS ----
// Admin: todo permitido
if ($role === 'admin') {
  return;
}

// Analyst: ejemplo (ajusta a tu gusto)
if ($role === 'analyst') {
  // Permite todo lo del viewer y además estas:
  $analystExtra = [
    'financiera.html',
    'operaciones - g4 services.html',
    'operaciones - cargapro.html',
  ];
  if (in_array($base, array_map('strtolower', $analystExtra))) return;
  // cae a comprobación de viewer
}

// Viewer: SOLO dos páginas (ajústalas)
$viewerAllowed = [
  // añade aquí otras si quieres
];

$gerenteRoles = [
  'GerenteProgan' => ['Gerenteprogan.php'],
  'GerenteCargaPro' => ['Gerentecargapro.php'],
  'GerenteG4' => ['GerenteG4.php'],
  'GerenteCIprogan' => ['ci.php'],
  'GerenteAcerum' => ['acerum.php'],
  'GerenteInverde' => ['inverde.php'],
  'Invitado' => ['index.php'], // solo la principal
];

// Mira solo el nombre del archivo (no la carpeta)
if (in_array($base, array_map('strtolower',$viewerAllowed))) {
  return; // permitido
}

// --- ✅ Nuevo bloque que evalúa permisos de gerentes ---
if (isset($gerenteRoles[$role])) {
  if (in_array($base, array_map('strtolower', $gerenteRoles[$role]))) {
    return; // permitido
  }
}

// 7) Si llegó aquí: no tiene permiso
http_response_code(403);
echo '<!doctype html><meta charset="utf-8"><style>
body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#0b1a14;color:#e6fff2;padding:40px}
.box{max-width:720px;margin:0 auto;background:#11261d66;border:1px solid #2c5a49;border-radius:12px;padding:22px}
a{color:#7de0ab;text-decoration:none}
</style><div class="box"><h2>Acceso restringido</h2>
<p>No tienes permisos para ver esta página.</p>
<p><a href="/">Volver al inicio</a> · <a href="/logout.php">Cerrar sesión</a></p></div>';
exit;