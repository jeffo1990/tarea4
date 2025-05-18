<?php
// includes/login.php
session_start();
include 'db.php';  // Asegúrate de que aquí cargas tu conexión mysqli en $conexion

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Prepara y ejecuta la consulta
    $stmt = $conexion->prepare("SELECT id, email, password, rol FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Obtiene el resultado como un objeto mysqli_result
    $result = $stmt->get_result();

    // Si existe el usuario
    if ($user = $result->fetch_assoc()) {
        // Verifica el password
        if (password_verify($password, $user['password'])) {
            // Credenciales correctas → inicia sesión
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['rol']        = $user['rol'];
            header("Location: ../tareas.php");
            exit();
        }
    }

    // Si llega aquí, es porque falló la validación
    header("Location: ../index.php?error=1");
    exit();
}
