<?php
include '../includes/db.php';
$stmt = $pdo->query("SELECT * FROM slides ORDER BY created_at DESC");
$slides = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Slides</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <h1>Slides</h1>
  <a href="form_slide.php">Adicionar Slide</a>
  <table border="1" cellpadding="10">
    <tr>
      <th>Imagem</th>
      <th>Título</th>
      <th>Descrição</th>
      <th>Link</th>
      <th>Ações</th>
    </tr>
    <?php foreach ($slides as $slide): ?>
      <tr>
        <td><img src="../uploads/<?= $slide['imagem'] ?>" width="100"></td>
        <td><?= $slide['titulo'] ?></td>
        <td><?= $slide['descricao'] ?></td>
        <td><a href="<?= $slide['link'] ?>" target="_blank">Ver</a></td>
        <td>
          <a href="form_slide.php?id=<?= $slide['id'] ?>">Editar</a> |
          <a href="delete_slide.php?id=<?= $slide['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
