<header class="main-header">
<a href="<?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] ?>/desafio_revvo/index.php" class="logo">Revvo</a>

  <form class="search-form" method="GET" action="#">
    <input type="text" name="busca" placeholder="Buscar cursos..." />
    <button type="submit">🔍</button>
  </form>

<div class="user-profile" onclick="toggleDropdown(event)">
  <img src="<?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] ?>/desafio_revvo/img/Foto.jpg" alt="Avatar do usuário">
  <span>Leonardo ▾</span>
  <div class="dropdown-menu" id="profileDropdown">
    <a href="/desafio_revvo/pages/list_cursos.php">📚 Listar Cursos</a>
    <a href="/desafio_revvo/pages/list_slides.php">🖼️ Listar Slides</a>
    <a href="/desafio_revvo/pages/form_curso.php">➕ Novo Curso</a>
    
  </div>
</div>

</header>
