<?php require __DIR__ . '/../app/db.php'; ?>
<?php require __DIR__ . '/../app/helpers.php'; ?>
<?php require_once __DIR__ . '/../app/auth.php'; login_required(); ?>
<?php include __DIR__ . '/views/partials/header.php'; ?>

<h2>Verificación</h2>
<?php $q = trim($_GET['q'] ?? ''); ?>
<form method="get" action="/verificacion.php">
  <div class="form-grid">
    <div class="form-group">
      <label>Buscar por ID_Med/ID_Disp, Documento o Paciente</label>
      <input name="q" value="<?= h($q) ?>" placeholder="MED123, 1034..., Juan Pérez...">
    </div>
    <div class="form-group"><label>&nbsp;</label><button class="btn">Buscar</button></div>
  </div>
</form>

<?php if ($q !== ''): ?>
<?php
$like = '%'.$q.'%';
/* Medicamentos */
$count = $pdo->prepare("SELECT COUNT(*) c FROM kardex_med WHERE id_med LIKE :q OR documento LIKE :q OR paciente LIKE :q");
$count->execute([':q'=>$like]); $total=(int)$count->fetch()['c'];
list($page,$pages,$offset,$per) = paginate($total, 20);
$stmt = $pdo->prepare("SELECT fecha,id_med,tipo,cantidad,sede,servicio,documento,paciente FROM kardex_med
                       WHERE id_med LIKE :q OR documento LIKE :q OR paciente LIKE :q
                       ORDER BY fecha DESC LIMIT :per OFFSET :off");
$stmt->bindValue(':q',$like,PDO::PARAM_STR);
$stmt->bindValue(':per',$per,PDO::PARAM_INT);
$stmt->bindValue(':off',$offset,PDO::PARAM_INT);
$stmt->execute();
?>
<h3>Movimientos (Medicamentos)</h3>
<table class="respuestas-table">
  <thead><tr><th>Fecha</th><th>ID_Med</th><th>Tipo</th><th>Cant</th><th>Sede</th><th>Servicio</th><th>Documento</th><th>Paciente</th></tr></thead>
  <tbody>
  <?php foreach ($stmt as $r): ?>
    <tr>
      <td><?= h($r['fecha']) ?></td><td><?= h($r['id_med']) ?></td><td><?= h($r['tipo']) ?></td>
      <td><?= (int)$r['cantidad'] ?></td><td><?= h($r['sede']) ?></td><td><?= h($r['servicio']) ?></td>
      <td><?= h($r['documento']) ?></td><td><?= h($r['paciente']) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php render_pagination($page,$pages,"/verificacion.php?q=".urlencode($q)); ?>

<?php
/* Dispositivos */
$count2 = $pdo->prepare("SELECT COUNT(*) c FROM kardex_disp WHERE id_disp LIKE :q OR profesional LIKE :q");
$count2->execute([':q'=>$like]); $total2=(int)$count2->fetch()['c'];
list($page2,$pages2,$offset2,$per2) = paginate($total2, 20);
$stmt2 = $pdo->prepare("SELECT fecha,id_disp,tipo,cantidad,sede,servicio,profesional FROM kardex_disp
                        WHERE id_disp LIKE :q OR profesional LIKE :q
                        ORDER BY fecha DESC LIMIT :per OFFSET :off");
$stmt2->bindValue(':q',$like,PDO::PARAM_STR);
$stmt2->bindValue(':per',$per2,PDO::PARAM_INT);
$stmt2->bindValue(':off',$offset2,PDO::PARAM_INT);
$stmt2->execute();
?>
<h3>Movimientos (Dispositivos)</h3>
<table class="respuestas-table">
  <thead><tr><th>Fecha</th><th>ID_Disp</th><th>Tipo</th><th>Cant</th><th>Sede</th><th>Servicio</th><th>Profesional</th></tr></thead>
  <tbody>
  <?php foreach ($stmt2 as $r): ?>
    <tr>
      <td><?= h($r['fecha']) ?></td><td><?= h($r['id_disp']) ?></td><td><?= h($r['tipo']) ?></td>
      <td><?= (int)$r['cantidad'] ?></td><td><?= h($r['sede']) ?></td><td><?= h($r['servicio']) ?></td>
      <td><?= h($r['profesional']) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php render_pagination($page2,$pages2,"/verificacion.php?q=".urlencode($q)); ?>
<?php endif; ?>

<?php include __DIR__ . '/views/partials/footer.php'; ?>
