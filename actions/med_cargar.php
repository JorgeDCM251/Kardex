<?php
require_once __DIR__ . '/../../app/auth.php'; role_required(['admin','gestor','operador']);
$req = ['id_med','sede','servicio','cantidad','fecha'];
foreach ($req as $r) { if (empty($_POST[$r])) { http_response_code(400); exit("Falta: $r"); } }
$stmt = $pdo->prepare("INSERT INTO kardex_med (id_med,sede,servicio,tipo,cantidad,fecha,lote,fecha_vencimiento,profesional,observacion)
VALUES (:id_med,:sede,:servicio,'ENTRADA',:cantidad,:fecha,:lote,:fecha_vencimiento,:profesional,:observacion)");
$stmt->execute([
  ':id_med'=>$_POST['id_med'], ':sede'=>$_POST['sede'], ':servicio'=>$_POST['servicio'],
  ':cantidad'=>(int)$_POST['cantidad'], ':fecha'=>$_POST['fecha'],
  ':lote'=>$_POST['lote'] ?? null, ':fecha_vencimiento'=>$_POST['fecha_vencimiento'] ?? null,
  ':profesional'=>$_POST['profesional'] ?? null, ':observacion'=>$_POST['observacion'] ?? null,
]);
header('Location: /carga.php?ok=1');
