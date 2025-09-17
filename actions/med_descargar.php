<?php
require_once __DIR__ . '/../../app/auth.php'; role_required(['admin','gestor','operador']);
$req = ['id_med','sede','servicio','cantidad','fecha'];
foreach ($req as $r) { if (empty($_POST[$r])) { http_response_code(400); exit("Falta: $r"); } }
$stmt = $pdo->prepare("INSERT INTO kardex_med (id_med,sede,servicio,tipo,cantidad,fecha,profesional,documento,paciente,observacion)
VALUES (:id_med,:sede,:servicio,'SALIDA',:cantidad,:fecha,:profesional,:documento,:paciente,:observacion)");
$stmt->execute([
  ':id_med'=>$_POST['id_med'], ':sede'=>$_POST['sede'], ':servicio'=>$_POST['servicio'],
  ':cantidad'=>(int)$_POST['cantidad'], ':fecha'=>$_POST['fecha'],
  ':profesional'=>$_POST['profesional'] ?? null, ':documento'=>$_POST['documento'] ?? null,
  ':paciente'=>$_POST['paciente'] ?? null, ':observacion'=>$_POST['observacion'] ?? null,
]);
header('Location: /descarga.php?ok=1');
