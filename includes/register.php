<?php
session_start();
include 'db.php';  

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../register.php');
    exit;
}

$email  = trim($_POST['email']);
$pass1  = $_POST['password'];
$pass2  = $_POST['password2'];

if ($pass1 !== $pass2) {
    header('Location: ../register.php?error=Las contraseñas no coinciden');
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../register.php?error=Email no válido');
    exit;
}

$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();               
if ($stmt->num_rows > 0) {
    $stmt->close();
    header('Location: ../register.php?error=El correo ya está registrado');
    exit;
}
$stmt->close();

$hash = password_hash($pass1, PASSWORD_DEFAULT);
$stmt = $conexion->prepare("INSERT INTO usuarios (email, password, rol) VALUES (?, ?, 'usuario')");
$stmt->bind_param("ss", $email, $hash);

if ($stmt->execute()) {
    $stmt->close();
    header('Location: ../register.php?ok=1');
    exit;
} else {
    $stmt->close();
    header('Location: ../register.php?error=Error al registrar');
    exit;
}
?>
