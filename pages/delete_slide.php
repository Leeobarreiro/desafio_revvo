<?php
include '../includes/db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    // opcional: remover imagem do diretório
    $stmt = $pdo->prepare("SELECT imagem FROM slides WHERE id = ?");
    $stmt->execute([$id]);
    $slide = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($slide && file_exists("../uploads/" . $slide['imagem'])) {
        unlink("../uploads/" . $slide['imagem']);
    }

    $stmt = $pdo->prepare("DELETE FROM slides WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: list_slides.php");
exit;
