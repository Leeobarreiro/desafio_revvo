<?php
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../middleware.php';

$sql = "SELECT s.*, c.titulo AS curso_titulo
        FROM slideshow s
        LEFT JOIN cursos c ON c.id = s.curso_id
        ORDER BY s.id DESC";

$stmt = $pdo->query($sql);
$slides = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Slideshow</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<div class="container" style="padding:40px 0;">
    <h1>Gerenciar Slideshow</h1>

    <div style="margin:20px 0;">
        <a href="criar.php" class="btn">Adicionar Slide</a>
        <a href="../index.php" class="btn" style="background:#555;">Voltar</a>
    </div>

    <?php if (isset($_GET['sucesso'])): ?>
        <p style="color: green; margin-bottom: 20px;">Operação realizada com sucesso!</p>
    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0" width="100%" style="background:#fff;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagem</th>
                <th>Título</th>
                <th>Curso Vinculado</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($slides)): ?>
                <?php foreach ($slides as $slide): ?>
                    <tr>
                        <td><?php echo $slide['id']; ?></td>
                        <td>
                            <img src="../../assets/uploads/<?php echo htmlspecialchars($slide['imagem']); ?>" width="120" alt="<?php echo htmlspecialchars($slide['titulo']); ?>">
                        </td>
                        <td><?php echo htmlspecialchars($slide['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($slide['curso_titulo'] ?? 'Curso não encontrado'); ?></td>
                        <td><?php echo $slide['ativo'] ? 'Ativo' : 'Inativo'; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $slide['id']; ?>">Editar</a> |
                            <a href="excluir.php?id=<?php echo $slide['id']; ?>" onclick="return confirm('Excluir slide?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum slide cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>