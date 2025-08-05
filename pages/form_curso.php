<?php
include '../includes/db.php';

$id = $_GET['id'] ?? null;
$curso = ['nome' => '', 'descricao' => '', 'imagem' => ''];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM cursos WHERE id = ?");
    $stmt->execute([$id]);
    $curso = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<?php include '../includes/layout_start.php'; ?>
<?php include '../includes/header.php'; ?>

<div class="wrapper">
  <div class="form-wrapper">
    <h1><?= $id ? 'Editar' : 'Novo' ?> Curso</h1>

    <form action="save_curso.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $id ?>">

      <label>Nome:
        <input type="text" name="nome" required value="<?= htmlspecialchars($curso['nome']) ?>">
      </label>

      <label>Descrição:
        <textarea name="descricao" required><?= htmlspecialchars($curso['descricao']) ?></textarea>
      </label>

      <?php if (!empty($curso['imagem'])): ?>
        <label>Imagem atual:</label>
        <img src="../uploads/<?= $curso['imagem'] ?>" width="200">
      <?php endif; ?>

      <label>Imagem:
        <input type="file" name="imagem">
      </label>

      <button type="submit">Salvar</button>
    </form>

    <a href="list_cursos.php" class="btn-voltar">Voltar</a>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
<?php include '../includes/layout_end.php'; ?>
