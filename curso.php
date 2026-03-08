<?php
require_once 'config/config.php';
require_once 'config/database.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM cursos WHERE id = :id");
$stmt->execute([':id' => $id]);
$curso = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$curso) {
    die('Curso não encontrado.');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($curso['titulo']); ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="container" style="padding: 40px 0;">
    <div style="background:#fff; padding:24px; border-radius:12px; box-shadow:0 6px 18px rgba(0,0,0,0.05);">
        <img
            src="assets/uploads/<?php echo htmlspecialchars($curso['imagem']); ?>"
            alt="<?php echo htmlspecialchars($curso['titulo']); ?>"
            style="width:100%; max-width:600px; display:block; margin:0 auto 24px; border-radius:12px;"
        >

        <h1 style="margin-bottom:16px;">
            <?php echo htmlspecialchars($curso['titulo']); ?>
        </h1>

        <p style="line-height:1.7; color:#4b5563;">
            <?php echo nl2br(htmlspecialchars($curso['descricao'])); ?>
        </p>

        <div style="margin-top:24px;">
            <a href="index.php" class="btn" style="background:#555;">Voltar</a>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>