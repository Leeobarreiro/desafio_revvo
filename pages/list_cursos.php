<?php
include '../includes/db.php';
include '../includes/layout_start.php';
include '../includes/header.php';

// Buscar cursos no banco
$stmt = $pdo->query("SELECT * FROM cursos ORDER BY id DESC");
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="wrapper">
  <section class="cursos-section">
    <div class="cursos-header">
      <h2>Lista de Cursos</h2>
      <a href="form_curso.php" class="curso-button add-slide-button"> ➕ Novo Curso</a>
    </div>

    <?php if (count($cursos) === 0): ?>
      <p>Nenhum curso cadastrado.</p>
    <?php else: ?>
      <div class="cursos-grid">
        <?php foreach ($cursos as $curso): ?>
          <div class="curso-card">
            <img src="../uploads/<?= htmlspecialchars($curso['imagem']) ?>" alt="Imagem do curso">
            <div class="curso-info">
              <h3><?= htmlspecialchars($curso['nome']) ?></h3>
              <p><?= htmlspecialchars($curso['descricao']) ?></p>
              <div style="display: flex; gap: 10px;">
                <a href="form_curso.php?id=<?= $curso['id'] ?>" class="curso-button">Editar</a>
                <a href="delete_curso.php?id=<?= $curso['id'] ?>" class="curso-button" style="background: #dc3545;">Excluir</a>
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
