<?php
require_once '../../config/config.php';
require_once '../../config/database.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM slideshow WHERE id=:id");
$stmt->execute([':id'=>$id]);
$slide = $stmt->fetch(PDO::FETCH_ASSOC);

if ($slide) {

$img='../../assets/uploads/'.$slide['imagem'];

if (file_exists($img)) unlink($img);

$del=$pdo->prepare("DELETE FROM slideshow WHERE id=:id");
$del->execute([':id'=>$id]);

}

header('Location:listar.php');