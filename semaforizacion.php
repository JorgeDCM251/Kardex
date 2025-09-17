<?php require __DIR__ . '/../app/db.php'; ?>
<?php require __DIR__ . '/../app/helpers.php'; ?>
<?php require_once __DIR__ . '/../app/auth.php'; login_required(); ?>
<?php include __DIR__ . '/views/partials/header.php'; ?>

<h2>Semaforización (Medicamentos)</h2>
<?php $min = isset($_GET['min']) ? max(0, (int)$_GET['min']) : 10; $crit = isset($_GET['crit']) ? max(0, (int)$_GET['crit']) : 3; ?>
<form method="get" action="/semaforizacion.php">
  <div class="form-grid">
    <div class="form-group"><label>Umbral Amarillo (<=)</label><input type="number" name="min" value="<?= h($min) ?>"></div>
    <div class="form-group"><label>Umbral Rojo (<=)</label><input type="number" name="crit" value="<?= h($crit) ?>"></div>
    <div class="form-group"><label>&nbsp;</label><button class="btn">Aplicar</button></div>
  </div>
</form>
<table class="question-table">
  <thead><tr><th>ID_Med</th><th>Nombre</th><th>Sede</th><th>Servicio</th><th>Stock</th><th>Estado</th></tr></thead>
  <tbody>
<?php
$stmt = $pdo->query("SELECT s.id_med, m.nombre, s.sede, s.servicio, s.stock FROM stock_med s
                     LEFT JOIN medicamento m ON m.id_med=s.id_med
                     ORDER BY s.stock ASC LIMIT 500");
foreach ($stmt as $r) {
  $txt='OK'; 
  if ($r['stock'] <= $crit){ $txt='CRÍTICO'; }
  elseif ($r['stock'] <= $min){ $txt='BAJO'; }
  echo '<tr><td>'.h($r['id_med']).'</td><td>'.h($r['nombre']).'</td><td>'.h($r['sede']).'</td><td>'.h($r['servicio']).'</td><td>'.(int)$r['stock'].'</td><td><span class="badge">'.h($txt).'</span></td></tr>';
}
?>
  </tbody>
</table>

<?php include __DIR__ . '/views/partials/footer.php'; ?>
