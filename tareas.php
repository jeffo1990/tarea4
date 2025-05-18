<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
include 'includes/db.php';

$usuario_id = $_SESSION['usuario_id'];
$rol        = $_SESSION['rol'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['titulo'])) {
    $titulo = trim($_POST['titulo']);
    $stmt = $conexion->prepare("INSERT INTO tareas (titulo, id_usuario) VALUES (?, ?)");
    $stmt->bind_param("si", $titulo, $usuario_id);
    $stmt->execute();
    $stmt->close();
    header("Location: tareas.php");
    exit;
}

if (isset($_GET['eliminar']) && $rol === 'admin') {
    $id = intval($_GET['eliminar']);
    $stmt = $conexion->prepare("DELETE FROM tareas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: tareas.php");
    exit;
}

if (isset($_GET['completar'])) {
    $id = intval($_GET['completar']);
    $stmt = $conexion->prepare("UPDATE tareas SET completada = NOT completada WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: tareas.php");
    exit;
}

if ($rol === 'admin') {
    $result = $conexion->query("SELECT * FROM tareas ORDER BY id DESC");
} else {
    $stmt = $conexion->prepare("SELECT * FROM tareas WHERE id_usuario = ? ORDER BY id DESC");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Mis Tareas</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <div class="tasks-container">
    <header class="tasks-header">
      <h1>Bienvenido, <span class="role-badge"><?= htmlspecialchars($rol) ?></span></h1>
      <a class="btn-logout" href="includes/logout.php">Cerrar sesión</a>
    </header>

    <div class="tasks-card">
      <form class="tasks-form" method="POST" action="tareas.php">
        <input type="text" name="titulo" placeholder="Añadir nueva tarea..." required>
        <button class="btn-add" type="submit">Agregar</button>
      </form>

      <ul class="tasks-list">
        <?php while ($tarea = $result->fetch_assoc()): ?>
        <li class="task-item <?= $tarea['completada'] ? 'completed' : '' ?>">
          <span><?= htmlspecialchars($tarea['titulo']) ?></span>
          <div class="task-actions">
            <a class="btn-action" href="?completar=<?= $tarea['id'] ?>">✅</a>
            <?php if ($rol === 'admin'): ?>
            <a class="btn-action btn-delete" href="?eliminar=<?= $tarea['id'] ?>" onclick="return confirm('¿Eliminar esta tarea?')">❌</a>
            <?php endif; ?>
          </div>
        </li>
        <?php endwhile; ?>
      </ul>
    </div>
  </div>
</body>
</html>
