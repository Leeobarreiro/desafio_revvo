<?php
include '../includes/db.php';

$id = $_POST['id'] ?? null;
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];

if ($id) {
    $stmt = $pdo->prepare("UPDATE cursos SET nome = ?, descricao = ? WHERE id = ?");
    $stmt->execute([$nome, $descricao, $id]);
} else {
    $stmt = $pdo->prepare("INSERT INTO cursos (nome, descricao) VALUES (?, ?)");
    $stmt->execute([$nome, $descricao]);
}

header("Location: list_cursos.php");
exit;
