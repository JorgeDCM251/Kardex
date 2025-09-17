<?php
$config = require __DIR__ . '/config.php';
$dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset={$config['db_charset']}";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
  $pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], $options);
} catch (PDOException $e) {
  http_response_code(500);
  echo "DB error: " . htmlspecialchars($e->getMessage());
  exit;
}
if (session_status() === PHP_SESSION_NONE) { session_start(); }
