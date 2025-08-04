<?php include 'includes/db.php'; ?>
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

  <div class="wrapper">

  <!-- Modal de primeiro acesso -->
  <div id="meuModal" style="display:none; position:fixed; top:0; left:0; background:rgba(0,0,0,0.8); width:100%; height:100%; z-index:10;">
    <div style="margin:10% auto; padding:20px; background:#fff; width:300px; position:relative;">
      <p>Seja bem-vindo! Esse é o seu primeiro acesso.</p>
      <button id="fecharModal">Fechar</button>
    </div>
  </div>

  <!-- HEADER -->
  <header class="main-header">
    <div class="logo">Reevo</div>

    <form class="search-form" method="GET" action="#">
      <input type="text" name="busca" placeholder="Buscar cursos..." />
      <button type="submit">🔍</button>
    </form>

    <div class="user-profile">
      <img src="https://i.pravatar.cc/40?img=1" alt="Avatar do usuário">
      <span>Leonardo</span>
    </div>
  </header>


  <!-- Carrossel de slides -->
  <div class="carousel-container">
    <div class="carousel-slides">
      <?php
      $stmt = $pdo->query("SELECT * FROM slides ORDER BY created_at DESC");
      $slides = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($slides as $index => $slide):
      ?>
        <div class="slide<?= $index === 0 ? ' active' : '' ?>">
          <img src="uploads/<?= $slide['imagem'] ?>" alt="<?= htmlspecialchars($slide['titulo']) ?>">
          <div class="slide-content">
            <h2><?= htmlspecialchars($slide['titulo']) ?></h2>
            <p><?= htmlspecialchars($slide['descricao']) ?></p>
            <a class="slide-button" href="<?= $slide['link'] ?>" target="_blank">Ver Curso</a>
          </div>
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


  <!-- Seção Meus Cursos (fora do carrossel) -->
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
          <img src="https://via.placeholder.com/300x150.png?text=Curso" alt="Imagem do curso">
          <div class="curso-info">
            <h3><?= htmlspecialchars($curso['nome']) ?></h3>
            <p><?= htmlspecialchars($curso['descricao']) ?></p>
            <a class="curso-button" href="pages/form_curso.php?id=<?= $curso['id'] ?>">Ver Curso</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  </div>


  <!-- FOOTER -->
<footer class="main-footer">
  <div class="footer-content">
    <div class="footer-column">
      <h3>Reevo</h3>
      <p>Educação que transforma.</p>
    </div>

    <div class="footer-column">
      <h4>Contato</h4>
      <p>Email: contato@reevo.com</p>
      <p>Telefone: (51) 99999-9999</p>
    </div>

    <div class="footer-column">
      <h4>Siga-nos</h4>
      <div class="social-icons">
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" /></a>
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" alt="Instagram" /></a>
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="LinkedIn" /></a>
      </div>
    </div>
  </div>
</footer>

</body>
</html>
