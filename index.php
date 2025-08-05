<?php
include 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Desafio Revvo</title>
  <link rel="stylesheet" href="css/style.css">
  <script defer src="js/modal.js"></script>
  <script defer src="js/carousel.js"></script>
</head>
<body>

<?php include 'includes/header.php'; ?>

<?php if (!isset($_GET['no_modal'])): ?>
  <div id="meuModal" class="modal">
    <div class="modal-content">
      <span id="fecharModal" class="close">&times;</span>
      <h2>Bem-vindo(a)!</h2>
      <p>Este é o seu primeiro acesso ao sistema. Explore os cursos e slides disponíveis!</p>
    </div>
  </div>
<?php endif; ?>


<div class="wrapper">
  <!-- Carrossel -->
  <div class="carousel-container">
    <div class="carousel-slides">
      <?php
      $stmt = $pdo->query("SELECT * FROM slides ORDER BY created_at DESC");
      $slides = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($slides as $index => $slide):
      ?>
        <div class="slide<?= $index === 0 ? ' active' : '' ?>">
      
        <!-- Link vinculado a imagem -->    
        <?php if (!empty($slide['link'])): ?>
          <a href="<?= htmlspecialchars($slide['link']) ?>" target="_blank" rel="noopener noreferrer">
            <img src="uploads/<?= $slide['imagem'] ?>" alt="<?= htmlspecialchars($slide['titulo']) ?>">
          </a>
        <?php else: ?>
          <img src="uploads/<?= $slide['imagem'] ?>" alt="<?= htmlspecialchars($slide['titulo']) ?>">
        <?php endif; ?>
          
        </div>

      <?php endforeach; ?>
    </div>

    <button class="nav prev">&#10094;</button>
    <button class="nav next">&#10095;</button>

    <div class="carousel-dots">
      <?php foreach ($slides as $index => $_): ?>
        <span class="dot<?= $index === 0 ? ' active' : '' ?>" data-slide="<?= $index ?>"></span>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Cursos -->
  <section class="cursos-section">
    <div class="cursos-header">
      <h2>Meus Cursos</h2>
    </div>

    <div class="cursos-grid">
      <a href="pages/form_curso.php" class="curso-card add-card">
        <span>+ Adicionar Curso</span>
      </a>

      <?php
      $stmt = $pdo->query("SELECT * FROM cursos ORDER BY created_at DESC");
      $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($cursos as $curso):
      ?>
        <div class="curso-card">
          <img src="uploads/<?= htmlspecialchars($curso['imagem']) ?: 'https://via.placeholder.com/300x150.png?text=Curso' ?>" alt="Imagem do curso">
          <div class="curso-info">
            <h3><?= htmlspecialchars($curso['nome']) ?></h3>
            <p><?= htmlspecialchars($curso['descricao']) ?></p>
            <a class="curso-button" href="pages/form_curso.php?id=<?= $curso['id'] ?>">Editar Curso</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
