<?php
include '../includes/db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM cursos WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: list_cursos.php");
exit;
