<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <h1 class="login-title">Gestión de Tareas</h1>
      <form class="login-form" method="POST" action="includes/login.php">
        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input type="email" id="email" name="email" placeholder="usuario@ejemplo.com" required>
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" placeholder="********" required>
        </div>
        <button class="btn-primary" type="submit">Entrar</button>
      </form>

      <?php if (isset($_GET['error'])): ?>
        <p class="error-msg">Credenciales incorrectas</p>
      <?php endif; ?>

      <p class="register-link">
        ¿No tienes cuenta? <a href="register.php">Regístrate aquí</a>
      </p>
    </div>
  </div>
</body>
</html>
