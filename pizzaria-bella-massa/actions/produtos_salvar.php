<?php

session_start();
require_once __DIR__ . '/../config/database.php';

if (empty($_SESSION['is_admin']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit;
}

$id        = (int)($_POST['id'] ?? 0);
$nome      = trim($_POST['nome'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$tipo      = $_POST['tipo'] ?? '';
$preco     = (float)str_replace(',', '.', $_POST['preco'] ?? '0');


if ($nome === '' || $preco <= 0 || !in_array($tipo, ['pizza', 'bebida'], true)) {
    header('Location: ../admin/produtos.php?erro=1');
    exit;
}

if ($id > 0) {
    
    $stmt = $pdo->prepare(
        "UPDATE produtos
         SET nome = :nome, descricao = :descricao, preco = :preco, tipo = :tipo
         WHERE id = :id"
    );
    $stmt->execute([
        ':nome' => $nome, ':descricao' => $descricao,
        ':preco' => $preco, ':tipo' => $tipo, ':id' => $id,
    ]);
} else {
   
    $stmt = $pdo->prepare(
        "INSERT INTO produtos (nome, descricao, preco, tipo)
         VALUES (:nome, :descricao, :preco, :tipo)"
    );
    $stmt->execute([
        ':nome' => $nome, ':descricao' => $descricao,
        ':preco' => $preco, ':tipo' => $tipo,
    ]);
}

header('Location: ../admin/produtos.php');
exit;
