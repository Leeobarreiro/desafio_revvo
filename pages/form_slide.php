<?php
include '../includes/db.php';

$id = $_GET['id'] ?? null;
$slide = ['titulo' => '', 'descricao' => '', 'link' => '', 'imagem' => ''];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM slides WHERE id = ?");
    $stmt->execute([$id]);
    $slide = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title><?= $id ? 'Editar' : 'Novo' ?> Slide</title>
</head>
<body>
  <h1><?= $id ? 'Editar' : 'Novo' ?> Slide</h1>
  <form action="save_slide.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">
    <?php if ($slide['imagem']): ?>
      <p><img src="../uploads/<?= $slide['imagem'] ?>" width="150"></p>
    <?php endif; ?>
    <label>Imagem: <input type="file" name="imagem"></label><br><br>
    <label>Título:<br> <input type="text" name="titulo" required value="<?= $slide['titulo'] ?>"></label><br><br>
    <label>Descrição:<br> <textarea name="descricao" required><?= $slide['descricao'] ?></textarea></label><br><br>
    <label>Link:<br> <input type="text" name="link" required value="<?= $slide['link'] ?>"></label><br><br>
    <button type="submit">Salvar</button>
  </form>
  <br>
  <a href="list_slides.php">Voltar</a>
</body>
</html>
