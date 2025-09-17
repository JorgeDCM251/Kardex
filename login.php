<?php require __DIR__ . '/../app/db.php'; ?>
<?php require __DIR__ . '/../app/helpers.php'; ?>
<?php include __DIR__ . '/views/partials/header.php'; ?>

<?php if (!empty($_SESSION['user'])) { header('Location:/index.php'); exit; } ?>
<div class="form-section">
  <h3>Ingreso al sistema</h3>
  <?php if (isset($_GET['err'])): ?>
    <div class="alert alert-error"><i>⚠</i> Usuario o contraseña inválidos</div>
  <?php endif; ?>
  <form class="login-form" method="post" action="/login.php">
    <div class="form-group"><label class="required">Usuario</label><input name="username" required></div>
    <div class="form-group"><label class="required">Contraseña</label><input type="password" name="password" required></div>
    <div class="button-container"><button class="btn" type="submit">Entrar</button></div>
  </form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  require_once __DIR__ . '/../app/auth.php';
  $u = trim($_POST['username'] ?? ''); $p = $_POST['password'] ?? '';
  if ($u !== '' && $p !== '' && try_login($u, $p)) { header('Location: /index.php'); exit; }
  header('Location: /login.php?err=1'); exit;
}
?>

<?php include __DIR__ . '/views/partials/footer.php'; ?>
