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
    <link rel="stylesheet" href="../../assets/css/responsive.css">
</head>
<body>

<div class="container admin-page">

    <div class="admin-header">
        <div class="admin-title">
            <h1>Gerenciar Slideshow</h1>
            <p>Cadastre e organize os slides exibidos na página inicial.</p>
        </div>

        <div class="admin-actions">
            <a href="criar.php" class="btn">Adicionar Slide</a>
            <a href="../index.php" class="btn btn-dark">Voltar</a>
        </div>
    </div>

    <?php if (isset($_GET['sucesso'])): ?>
        <div class="admin-alert admin-alert-success">
            Operação realizada com sucesso!
        </div>
    <?php endif; ?>

    <div class="admin-card">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th>Curso Vinculado</th>
                        <th>Status</th>
                        <th style="width: 170px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($slides)): ?>
                        <?php foreach ($slides as $slide): ?>
                            <tr>
                                <td>
                                    <span class="admin-id">#<?php echo (int)$slide['id']; ?></span>
                                </td>
                                <td>
                                    <img
                                        src="../../assets/uploads/<?php echo htmlspecialchars($slide['imagem']); ?>"
                                        alt="<?php echo htmlspecialchars($slide['titulo']); ?>"
                                        class="admin-thumb admin-thumb-lg"
                                    >
                                </td>
                                <td>
                                    <span class="admin-course-name">
                                        <?php echo htmlspecialchars($slide['titulo']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($slide['curso_titulo'] ?? 'Curso não encontrado'); ?>
                                </td>
                                <td>
                                    <?php if (!empty($slide['ativo'])): ?>
                                        <span class="admin-badge admin-badge-success">Ativo</span>
                                    <?php else: ?>
                                        <span class="admin-badge admin-badge-muted">Inativo</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="admin-actions-links">
                                        <a href="editar.php?id=<?php echo (int)$slide['id']; ?>" class="admin-link admin-link-edit">
                                            Editar
                                        </a>
                                        <a
                                            href="excluir.php?id=<?php echo (int)$slide['id']; ?>"
                                            class="admin-link admin-link-delete"
                                            onclick="return confirm('Excluir slide?')"
                                        >
                                            Excluir
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="admin-empty">
                                Nenhum slide cadastrado.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>