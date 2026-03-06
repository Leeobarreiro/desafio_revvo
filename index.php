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
    // Usando para evitar quebrar a página no início
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
            <div class="container">
                <h2>Slideshow</h2>
                <p>Sem slides no banco por enquanto.</p>
            </div>
        </section>

        <section class="cursos">
            <div class="container">
                <h2>Meus Cursos</h2>

                <div class="cursos-grid">
                    <?php foreach ($cursos as $curso): ?>
                        <div class="card-curso">
                            <img src="assets/uploads/<?php echo htmlspecialchars($curso['imagem']); ?>" alt="<?php echo htmlspecialchars($curso['titulo']); ?>">
                            <h3><?php echo htmlspecialchars($curso['titulo']); ?></h3>
                            <p><?php echo htmlspecialchars($curso['descricao']); ?></p>
                            <a href="<?php echo htmlspecialchars($curso['link_botao']); ?>" class="btn">Ver curso</a>
                        </div>
                    <?php endforeach; ?>
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