<?php
include '../includes/db.php';

$stmt = $pdo->query("SELECT * FROM cursos ORDER BY created_at DESC");
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cursos</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <h1>Cursos</h1>
  <a href="form_curso.php">Adicionar Curso</a>
  <table border="1" cellpadding="10">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Descrição</th>
      <th>Ações</th>
    </tr>
    <?php foreach ($cursos as $curso): ?>
      <tr>
        <td><?= $curso['id'] ?></td>
        <td><?= $curso['nome'] ?></td>
        <td><?= $curso['descricao'] ?></td>
        <td>
          <a href="form_curso.php?id=<?= $curso['id'] ?>">Editar</a> |
          <a href="delete_curso.php?id=<?= $curso['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
