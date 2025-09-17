<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kardex</title>
  <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Kardex - Inventario</h1>
      <p>Entradas y salidas | Medicamentos & Dispositivos</p>
    </div>
    <div class="button-container" style="justify-content:space-between">
      <div>
        <a class="btn" href="/index.php">Inicio</a>
        <a class="btn" href="/menucarga.php">Cargar</a>
        <a class="btn" href="/menudescarga.php">Descargar</a>
        <a class="btn" href="/semaforizacion.php">Semaforización</a>
        <a class="btn" href="/verificacion.php">Verificación</a>
      </div>
      <div>
      <?php if (!empty($_SESSION['user'])): ?>
        <span class="badge">👤 <?= htmlspecialchars($_SESSION['user']['username']) ?> (<?= htmlspecialchars($_SESSION['user']['rol']) ?>)</span>
        <a class="btn logout" href="/logout.php">Salir</a>
      <?php else: ?>
        <a class="btn" href="/login.php">Ingresar</a>
      <?php endif; ?>
      </div>
    </div>
