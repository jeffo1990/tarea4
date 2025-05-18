<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Crear Cuenta</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <h1 class="login-title">Registro de Usuario</h1>

      <?php if (isset($_GET['error'])): ?>
        <p class="error-msg"><?= htmlspecialchars($_GET['error']) ?></p>
      <?php elseif (isset($_GET['ok'])): ?>
        <p class="success-msg">Registro exitoso. <a href="index.php">Inicia sesión</a></p>
      <?php endif; ?>

      <form class="login-form" method="POST" action="includes/register.php">
        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input type="email" id="email" name="email" placeholder="usuario@ejemplo.com" required>
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" placeholder="********" required>
        </div>
        <div class="form-group">
          <label for="password2">Repite la contraseña</label>
          <input type="password" id="password2" name="password2" placeholder="********" required>
        </div>
        <button class="btn-primary" type="submit">Registrarse</button>
      </form>

      <p class="register-link">
        ¿Ya tienes cuenta? <a href="index.php">Inicia sesión</a>
      </p>
    </div>
  </div>
</body>
</html>
