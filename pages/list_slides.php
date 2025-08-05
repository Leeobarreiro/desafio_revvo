<?php
include '../includes/db.php';
include '../includes/layout_start.php';
include '../includes/header.php';

$stmt = $pdo->query("SELECT * FROM slides ORDER BY created_at DESC");
$slides = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="wrapper">
  <section class="cursos-section">
    <div class="cursos-header">
      <h2>Lista de Slides</h2>
    <a href="form_slide.php" class="curso-button add-slide-button">
      ➕ Novo Slide
    </a>
    </div>

    <?php if (count($slides) === 0): ?>
      <p>Nenhum slide cadastrado.</p>
    <?php else: ?>
      <div class="cursos-grid">
        <?php foreach ($slides as $slide): ?>
          <div class="curso-card">
            <img src="../uploads/<?= htmlspecialchars($slide['imagem']) ?>" alt="Imagem do slide">
            <div class="curso-info">
              <h3><?= htmlspecialchars($slide['titulo']) ?></h3>
              <p><?= htmlspecialchars($slide['descricao']) ?></p>
              <div style="display: flex; gap: 10px;">
                <a href="form_slide.php?id=<?= $slide['id'] ?>" class="curso-button">Editar</a>
                <a href="delete_slide.php?id=<?= $slide['id'] ?>" class="curso-button" style="background: #dc3545;" onclick="return confirm('Tem certeza que deseja excluir este slide?')">Excluir</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </section>
</div>

<?php include '../includes/footer.php'; ?>
<?php include '../includes/layout_end.php'; ?>
