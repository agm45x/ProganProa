<?php
require_once "db.php";
require_once "guard.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: visorintegral.php");
  exit;
}

$id_usuario = $_POST['id_usuario'] ?? null;
$nuevo_rol = $_POST['nuevo_rol'] ?? null;

if ($id_usuario && $nuevo_rol) {
  $stmt = $mysqli->prepare("UPDATE users SET role = ? WHERE id = ?");
  $stmt->bind_param("si", $nuevo_rol, $id_usuario);
  $stmt->execute();
}

header("Location: admin_roles.php");
exit;
