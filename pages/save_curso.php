<?php
include '../includes/db.php';

// Captura os dados do formulário
$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$imagem = $_FILES['imagem'] ?? null;

// Verifica se foi enviado um novo arquivo de imagem
$nomeImagem = '';
if ($imagem && $imagem['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($imagem['name'], PATHINFO_EXTENSION);
    $nomeImagem = uniqid() . '.' . $ext;
    move_uploaded_file($imagem['tmp_name'], '../uploads/' . $nomeImagem);
}

// Se for atualização
if ($id) {
    if ($nomeImagem) {
        // Atualiza com nova imagem
        $stmt = $pdo->prepare("UPDATE cursos SET nome = ?, descricao = ?, imagem = ? WHERE id = ?");
        $stmt->execute([$nome, $descricao, $nomeImagem, $id]);
    } else {
        // Atualiza sem alterar imagem
        $stmt = $pdo->prepare("UPDATE cursos SET nome = ?, descricao = ? WHERE id = ?");
        $stmt->execute([$nome, $descricao, $id]);
    }
} else {
    // Inserção de novo curso
    $stmt = $pdo->prepare("INSERT INTO cursos (nome, descricao, imagem) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $descricao, $nomeImagem]);
}

// Redireciona de volta à lista de cursos
header('Location: list_cursos.php');
exit;
?>
