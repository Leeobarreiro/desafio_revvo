<?php
include '../includes/db.php';

$id = $_POST['id'] ?? null;
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$link = $_POST['link'] ?? '';
$imagem = '';

if ($_FILES['imagem']['name']) {
    $nomeArquivo = uniqid() . '_' . $_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'], '../uploads/' . $nomeArquivo);
    $imagem = $nomeArquivo;
}

if ($id) {
    if ($imagem) {
        $stmt = $pdo->prepare("UPDATE slides SET titulo=?, descricao=?, imagem=?, link=? WHERE id=?");
        $stmt->execute([$titulo, $descricao, $imagem, $link, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE slides SET titulo=?, descricao=?, link=? WHERE id=?");
        $stmt->execute([$titulo, $descricao, $link, $id]);
    }
} else {
    $stmt = $pdo->prepare("INSERT INTO slides (imagem, titulo, descricao, link) VALUES (?, ?, ?, ?)");
    $stmt->execute([$imagem, $titulo, $descricao, $link]);
}

header("Location: list_slides.php");
exit;
