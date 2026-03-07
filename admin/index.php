<?php
require_once '../config/config.php';
require_once 'middleware.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Desafio Revvo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container" style="padding: 40px 0;">
        <h1>Painel Administrativo</h1>
        <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></p>
        <hr style="margin: 20px 0;">

        <div style="background:#fff; padding:20px; border-radius:8px;">
            <ul style="list-style:none; padding:0; margin:0;">
                <li style="margin-bottom:12px;">
                    <a href="cursos/listar.php" class="btn">Gerenciar Cursos</a>
                </li>
                <li style="margin-bottom:12px;">
                    <a href="slideshow/listar.php" class="btn">Gerenciar Slideshow</a>
                </li>
                <li>
                    <a href="../index.php" class="btn" style="background:#555;">Ver site</a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>