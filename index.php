<?php
require_once 'config/config.php';
require_once 'config/database.php';

$mostrarModal = false;

if (!isset($_COOKIE['modal_exibido'])) {
    setcookie('modal_exibido', '1', time() + (86400 * 30), "/");
    $mostrarModal = true;
}

$cursos = [];
$slides = [];

try {

    $stmtCursos = $pdo->query("SELECT * FROM cursos ORDER BY id DESC");
    $cursos = $stmtCursos->fetchAll(PDO::FETCH_ASSOC);

    $stmtSlides = $pdo->query("SELECT * FROM slideshow WHERE ativo = 1 ORDER BY id DESC");
    $slides = $stmtSlides->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    // evita quebrar a página se algo falhar
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Desafio Revvo</title>

<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>

<!-- SLIDESHOW -->
<section class="banner">
<div class="container">

<?php if (!empty($slides)): ?>

<div class="slideshow">

<?php foreach ($slides as $slide): ?>

<div class="slide">

<img
src="assets/uploads/<?php echo htmlspecialchars($slide['imagem']); ?>"
alt="<?php echo htmlspecialchars($slide['titulo']); ?>"
>

<div class="slide-content">
<h2><?php echo htmlspecialchars($slide['titulo']); ?></h2>

<p><?php echo htmlspecialchars($slide['descricao']); ?></p>

<a
href="<?php echo htmlspecialchars($slide['link_botao']); ?>"
class="btn"
>
<?php echo htmlspecialchars($slide['texto_botao'] ?? 'Ver mais'); ?>
</a>

</div>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<h2>Slideshow</h2>
<p>Sem slides no banco por enquanto.</p>

<?php endif; ?>

</div>
</section>


<!-- CURSOS -->
<section class="cursos">
<div class="container">

<h2>Meus Cursos</h2>

<div class="cursos-grid">

<!-- CARD ADICIONAR CURSO -->
<div class="card-curso" style="display:flex;align-items:center;justify-content:center;min-height:320px;">
<a href="admin/cursos/criar.php" class="btn">
+ Adicionar Curso
</a>
</div>

<?php if (!empty($cursos)): ?>

<?php foreach ($cursos as $curso): ?>

<div class="card-curso">

<img
src="assets/uploads/<?php echo htmlspecialchars($curso['imagem']); ?>"
alt="<?php echo htmlspecialchars($curso['titulo']); ?>"
>

<h3><?php echo htmlspecialchars($curso['titulo']); ?></h3>

<p><?php echo htmlspecialchars($curso['descricao']); ?></p>

<a
href="curso.php?id=<?php echo $curso['id']; ?>"
class="btn"
>
Ver curso
</a>

</div>

<?php endforeach; ?>

<?php endif; ?>

</div>

</div>
</section>

</main>

<?php include 'includes/footer.php'; ?>


<?php if ($mostrarModal): ?>
<?php include 'includes/modal.php'; ?>
<?php endif; ?>


<script src="assets/js/main.js"></script>
<script src="assets/js/modal.js"></script>
<script src="assets/js/slideshow.js"></script>

</body>
</html>