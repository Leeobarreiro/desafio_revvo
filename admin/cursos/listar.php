<?php
require_once '../../config/config.php';
require_once '../../config/database.php';

$stmt = $pdo->query("SELECT * FROM cursos ORDER BY id DESC");
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cursos</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="container" style="padding: 40px 0;">
        <h1>Gerenciar Cursos</h1>

        <div style="margin: 20px 0;">
            <a href="criar.php" class="btn">Adicionar Curso</a>
            <a href="../index.php" class="btn" style="background:#555;">Voltar</a>
        </div>

        <?php if (isset($_GET['sucesso'])): ?>
            <p style="color: green; margin-bottom: 20px;">
                Operação realizada com sucesso!
            </p>
        <?php endif; ?>

        <table border="1" cellpadding="10" cellspacing="0" width="100%" style="background: #fff;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($cursos) > 0): ?>
                    <?php foreach ($cursos as $curso): ?>
                        <tr>
                            <td><?php echo $curso['id']; ?></td>
                            <td>
                                <img
                                    src="../../assets/uploads/<?php echo htmlspecialchars($curso['imagem']); ?>"
                                    alt="<?php echo htmlspecialchars($curso['titulo']); ?>"
                                    width="80"
                                >
                            </td>
                            <td><?php echo htmlspecialchars($curso['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($curso['descricao']); ?></td>
                            <td>
                                <a href="editar.php?id=<?php echo $curso['id']; ?>">Editar</a> |
                                <a href="excluir.php?id=<?php echo $curso['id']; ?>" onclick="return confirm('Deseja realmente excluir este curso?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Nenhum curso cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>