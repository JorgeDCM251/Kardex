<?php
require_once __DIR__ . '/../../app/auth.php'; role_required(['admin','gestor','operador']);
$req = ['id_disp','sede','servicio','cantidad','fecha'];
foreach ($req as $r) { if (empty($_POST[$r])) { http_response_code(400); exit("Falta: $r"); } }
$stmt = $pdo->prepare("INSERT INTO kardex_disp (id_disp,sede,servicio,tipo,cantidad,fecha,profesional,observacion)
VALUES (:id_disp,:sede,:servicio,'SALIDA',:cantidad,:fecha,:profesional,:observacion)");
$stmt->execute([
  ':id_disp'=>$_POST['id_disp'], ':sede'=>$_POST['sede'], ':servicio'=>$_POST['servicio'],
  ':cantidad'=>(int)$_POST['cantidad'], ':fecha'=>$_POST['fecha'],
  ':profesional'=>$_POST['profesional'] ?? null, ':observacion'=>$_POST['observacion'] ?? null,
]);
header('Location: /descarga_dispositivos.php?ok=1');
