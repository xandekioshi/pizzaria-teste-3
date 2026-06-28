<?php

session_start();
require_once __DIR__ . '/../config/database.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';


$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
$stmt->execute([':email' => $email]);
$usuario = $stmt->fetch();


if ($usuario && password_verify($senha, $usuario['senha'])) {
    
    $ehAdmin = in_array($usuario['is_admin'], [true, 't', '1', 1, 'true'], true);

    $_SESSION['usuario_id']   = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    $_SESSION['is_admin']     = $ehAdmin;

   
    if ($_SESSION['is_admin']) {
        header('Location: ../admin/dashboard.php');
    } else {
        header('Location: ../index.php');
    }
    exit;
}


header('Location: ../login.php?erro=1');
exit;
