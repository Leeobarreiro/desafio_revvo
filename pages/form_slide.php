<?php
include '../includes/db.php';
include '../includes/layout_start.php';
include '../includes/header.php';

$id = $_GET['id'] ?? null;
$slide = ['titulo' => '', 'descricao' => '', 'imagem' => ''];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM slides WHERE id = ?");
    $stmt->execute([$id]);
    $slide = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="wrapper">
  <div class="form-wrapper">
    <h1><?= $id ? 'Editar' : 'Novo' ?> Slide</h1>
    <form action="save_slide.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $id ?>">

      <?php if ($slide['imagem']): ?>
        <label>Imagem atual:</label>
        <img src="../uploads/<?= $slide['imagem'] ?>" width="200">
      <?php endif; ?>

      <label>Imagem:
        <input type="file" name="imagem">
      </label>

      <label>Título:
        <input type="text" name="titulo" required value="<?= htmlspecialchars($slide['titulo']) ?>">
      </label>

      <label>Descrição:
        <textarea name="descricao" required><?= htmlspecialchars($slide['descricao']) ?></textarea>
      </label>

      <label>Link do botão (opcional):
          <input type="url" name="link" placeholder="https://exemplo.com"
            value="<?= htmlspecialchars($slide['link'] ?? '') ?>">
      </label>


      <button type="submit">Salvar</button>
    </form>

    <a class="btn-voltar" href="list_slides.php">Voltar</a>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
<?php include '../includes/layout_end.php'; ?>
