<?php
require_once "guard.php";
require_once "db.php";

// Verificar acceso
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: visorintegral.php");
  exit;
}

// Obtener lista de usuarios
$sql = "SELECT id, username, email, role, is_active FROM users ORDER BY id ASC";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Roles</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      color: white;
      background: #0d0d0d;
      font-family: 'Segoe UI', sans-serif;
      padding: 40px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(0, 0, 0, 0.5);
      box-shadow: 0 0 10px rgba(0,255,132,0.3);
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 12px 16px;
      text-align: center;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    th {
      background: rgba(0, 255, 132, 0.2);
    }
    tr:hover {
      background: rgba(0,255,132,0.1);
    }
    select, button {
      padding: 6px 10px;
      border-radius: 6px;
      border: 1px solid #00ff84;
      background: #0e2019;
      color: white;
      cursor: pointer;
    }
    button {
      background: linear-gradient(180deg, #20a35a, #138a49);
      border: none;
    }
    button:hover {
      transform: scale(1.05);
    }
    .btn-volver {
      position: absolute;
      top: 20px;
      left: 30px;
    }
  </style>
</head>
<body>
  <a href="javascript:history.back()" class="btn-volver">
    <i class="fas fa-arrow-left"></i> Volver
  </a>

  <h1 style="text-align:center; margin-bottom:25px;">Administración de Roles</h1>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Email</th>
        <th>Rol Actual</th>
        <th>Nuevo Rol</th>
        <th>Activo</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <form action="actualizar_rol.php" method="POST">
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['username']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= $row['role'] ?></td>
          <td>
            <select name="nuevo_rol" required>
              <option value="viewer" <?= $row['role'] === 'viewer' ? 'selected' : '' ?>>Viewer</option>
              <option value="analyst" <?= $row['role'] === 'analyst' ? 'selected' : '' ?>>Analyst</option>
              <option value="admin" <?= $row['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
              <option value="GerenteProgan" <?= $row['role'] === 'GerenteProgan' ? 'selected' : '' ?>>Gerente Progan</option>
              <option value="GerenteCargaPro" <?= $row['role'] === 'GerenteCargaPro' ? 'selected' : '' ?>>Gerente Carga Pro</option>
              <option value="GerenteG4" <?= $row['role'] === 'GerenteG4' ? 'selected' : '' ?>>Gerente G4</option>
              <option value="GerenteCIprogan" <?= $row['role'] === 'GerenteCIprogan' ? 'selected' : '' ?>>Gerente CI Progan</option>
              <option value="GerenteAcerum" <?= $row['role'] === 'GerenteAcerum' ? 'selected' : '' ?>>Gerente Acerum</option>
              <option value="GerenteInverde" <?= $row['role'] === 'GerenteInverde' ? 'selected' : '' ?>>Gerente Inverde</option>
              <option value="Invitado" <?= $row['role'] === 'Invitado' ? 'selected' : '' ?>>Invitado</option>
              <option value="Visorintegral" <?= $row['role'] === 'Visorintegral' ? 'selected' : '' ?>>Visor Integral</option>
            </select>
          </td>
          <td><?= $row['is_active'] ? '✅' : '❌' ?></td>
          <td>
            <input type="hidden" name="id_usuario" value="<?= $row['id'] ?>">
            <button type="submit">Actualizar</button>
          </td>
        </form>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
