<?php
require_once __DIR__ . '/db.php';

function current_user(){
  return $_SESSION['user'] ?? null;
}

function login_required(){
  if (empty($_SESSION['user'])){
    header('Location: /login.php'); exit;
  }
}

function role_required($roles = []){
  login_required();
  $role = $_SESSION['user']['rol'] ?? '';
  if (!in_array($role, $roles)){
    http_response_code(403);
    echo "<div class='container'><div class='warning'>No tienes permisos suficientes.</div><p><a class='btn' href='/index.php'>Volver</a></p></div>";
    exit;
  }
}

function try_login($username, $password){
  global $pdo;
  $stmt = $pdo->prepare("SELECT id, username, password_hash, rol FROM usuarios WHERE username=:u LIMIT 1");
  $stmt->execute([':u'=>$username]);
  $user = $stmt->fetch();
  if (!$user) return false;
  // Soporta bcrypt moderno y SHA2 legado (del seed inicial)
  if (password_verify($password, $user['password_hash']) || hash('sha256', $password) === $user['password_hash']){
    $_SESSION['user'] = ['id'=>$user['id'], 'username'=>$user['username'], 'rol'=>$user['rol']];
    return true;
  }
  return false;
}

function logout(){
  session_destroy();
}
