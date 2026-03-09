<?php
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../middleware.php';

$stmt = $pdo->query("SELECT * FROM cursos ORDER BY id DESC");
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Cursos</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/responsive.css">
</head>
<body>

<div class="container admin-page">

    <div class="admin-header">
        <div class="admin-title">
            <h1>Gerenciar Cursos</h1>
            <p>Cadastre, edite e remova os cursos do sistema.</p>
        </div>

        <div class="admin-actions">
            <a href="criar.php" class="btn">Adicionar Curso</a>
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
                        <th>Descrição</th>
                        <th style="width: 170px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($cursos) > 0): ?>
                        <?php foreach ($cursos as $curso): ?>
                            <tr>
                                <td>
                                    <span class="admin-id">#<?php echo (int)$curso['id']; ?></span>
                                </td>
                                <td>
                                    <img
                                        src="../../assets/uploads/<?php echo htmlspecialchars($curso['imagem']); ?>"
                                        alt="<?php echo htmlspecialchars($curso['titulo']); ?>"
                                        class="admin-thumb"
                                    >
                                </td>
                                <td>
                                    <span class="admin-course-name">
                                        <?php echo htmlspecialchars($curso['titulo']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="admin-description">
                                        <?php echo htmlspecialchars($curso['descricao']); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="admin-actions-links">
                                        <a href="editar.php?id=<?php echo (int)$curso['id']; ?>" class="admin-link admin-link-edit">
                                            Editar
                                        </a>
                                        <a
                                            href="excluir.php?id=<?php echo (int)$curso['id']; ?>"
                                            class="admin-link admin-link-delete"
                                            onclick="return confirm('Deseja realmente excluir este curso?')"
                                        >
                                            Excluir
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="admin-empty">
                                Nenhum curso cadastrado.
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