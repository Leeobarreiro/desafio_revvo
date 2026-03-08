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

    <section class="banner">
        <?php if (!empty($slides)): ?>
            <div class="slideshow" id="slideshow">

                <?php foreach ($slides as $index => $slide): ?>
                    <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img
                            src="assets/uploads/<?php echo htmlspecialchars($slide['imagem']); ?>"
                            alt="<?php echo htmlspecialchars($slide['titulo']); ?>"
                        >

                        <div class="slide-content">
                            <h2><?php echo htmlspecialchars($slide['titulo']); ?></h2>
                            <p><?php echo htmlspecialchars($slide['descricao']); ?></p>
                            <a
                                href="curso.php?id=<?php echo (int)$slide['curso_id']; ?>"
                                class="btn"
                            >
                                <?php echo htmlspecialchars($slide['texto_botao'] ?? 'Ver curso'); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

                <button class="slide-nav slide-prev" type="button">&#10094;</button>
                <button class="slide-nav slide-next" type="button">&#10095;</button>

                <div class="slide-dots">
                    <?php foreach ($slides as $index => $slide): ?>
                        <span class="slide-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-slide="<?php echo $index; ?>"></span>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="container" style="padding: 40px 20px;">
                <h2>Slideshow</h2>
                <p>Cadastre um slide e ele aparecerá aqui.</p>
            </div>
        <?php endif; ?>
    </section>

    <section class="cursos">
        <div class="container">
            <h2>Meus Cursos</h2>

            <div class="cursos-grid">

                <?php if (!empty($cursos)): ?>
                    <?php foreach ($cursos as $curso): ?>
                        <div class="card-curso">
                            <img
                                src="assets/uploads/<?php echo htmlspecialchars($curso['imagem']); ?>"
                                alt="<?php echo htmlspecialchars($curso['titulo']); ?>"
                            >

                            <div class="card-curso-content">
                                <h3><?php echo htmlspecialchars($curso['titulo']); ?></h3>

                                <p><?php echo htmlspecialchars($curso['descricao']); ?></p>

                                <a
                                    href="curso.php?id=<?php echo (int)$curso['id']; ?>"
                                    class="btn"
                                >
                                    Ver curso
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

               <div class="card-add">
                <a href="admin/cursos/criar.php">

                    <div class="add-box">

                        <div class="add-icon">
                +
                        </div>

                    <div>
                        Adicionar<br>Curso
                    </div>

                    </div>

                </a>
                </div>

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