<?php
require_once '../../config/config.php';
require_once '../../config/database.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM cursos WHERE id = :id");
$stmt->execute([':id' => $id]);
$curso = $stmt->fetch(PDO::FETCH_ASSOC);

if ($curso) {
    if (!empty($curso['imagem'])) {
        $caminhoImagem = '../../assets/uploads/' . $curso['imagem'];

        if (file_exists($caminhoImagem)) {
            unlink($caminhoImagem);
        }
    }

    $stmtDelete = $pdo->prepare("DELETE FROM cursos WHERE id = :id");
    $stmtDelete->execute([':id' => $id]);
}

header('Location: listar.php?sucesso=1');
exit;