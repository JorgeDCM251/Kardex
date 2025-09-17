<?php require __DIR__ . '/../app/db.php'; ?>
<?php require __DIR__ . '/../app/helpers.php'; ?>
<?php require_once __DIR__ . '/../app/auth.php'; login_required(); ?>
<?php include __DIR__ . '/views/partials/header.php'; ?>

<h2>Carga (Dispositivos)</h2>
<form method="post" action="/actions/disp_cargar.php">
  <div class="form-section">
    <h3>Datos del movimiento</h3>
    <div class="form-grid">
      <div class="form-group"><label class="required">ID Dispositivo</label><input name="id_disp" required></div>
      <div class="form-group"><label class="required">Sede</label><select name="sede" required><?= options_from_table($pdo,'sede'); ?></select></div>
      <div class="form-group"><label class="required">Servicio</label><select name="servicio" required><?= options_from_table($pdo,'servicio'); ?></select></div>
      <div class="form-group"><label class="required">Cantidad</label><input type="number" name="cantidad" min="1" required></div>
      <div class="form-group"><label class="required">Fecha</label><input type="datetime-local" name="fecha" required></div>
      <div class="form-group"><label>Profesional</label><input name="profesional"></div>
      <div class="form-group"><label>Observación</label><input name="observacion"></div>
    </div>
  </div>
  <div class="button-container"><button class="btn" type="submit">Guardar ENTRADA</button></div>
</form>

<?php include __DIR__ . '/views/partials/footer.php'; ?>
