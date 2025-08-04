<?php
include '../includes/db.php';

$id = $_GET['id'] ?? null;
$curso = ['nome' => '', 'descricao' => ''];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM cursos WHERE id = ?");
    $stmt->execute([$id]);
    $curso = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title><?= $id ? 'Editar' : 'Novo' ?> Curso</title>
</head>
<body>
  <h1><?= $id ? 'Editar' : 'Novo' ?> Curso</h1>
  <form action="save_curso.php" method="POST">
    <input type="hidden" name="id" value="<?= $id ?>">
    <label>Nome:<br>
      <input type="text" name="nome" required value="<?= $curso['nome'] ?>">
    </label><br><br>
    <label>Descrição:<br>
      <textarea name="descricao" required><?= $curso['descricao'] ?></textarea>
    </label><br><br>
    <button type="submit">Salvar</button>
  </form>
  <br>
  <a href="list_cursos.php">Voltar</a>
</body>
</html>
