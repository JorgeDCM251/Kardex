<?php require __DIR__ . '/../app/db.php'; ?>
<?php require __DIR__ . '/../app/helpers.php'; ?>
<?php include __DIR__ . '/views/partials/header.php'; ?>

<div class="split-container">
  <div class="split-half">
    <h2>MenuCarga</h2>
    <p>Registra entradas (compras/abastecimientos) de medicamentos y dispositivos.</p>
    <div class="button-container">
      <a class="btn" href="/carga.php">Carga Medicamentos</a>
      <a class="btn" href="/carga_dispositivos.php">Carga Dispositivos</a>
    </div>
  </div>
  <div class="split-half">
    <h2>MenuDescarga</h2>
    <p>Registra salidas (entregas) a pacientes/servicios.</p>
    <div class="button-container">
      <a class="btn" href="/descarga.php">Descarga Medicamentos</a>
      <a class="btn" href="/descarga_dispositivos.php">Descarga Dispositivos</a>
    </div>
  </div>
</div>
<div class="note info">
  <div class="note-text">Usa el módulo de <b>Semaforización</b> para monitorear inventarios bajos o críticos.</div>
</div>

<?php include __DIR__ . '/views/partials/footer.php'; ?>
