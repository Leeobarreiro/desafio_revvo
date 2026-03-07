<?php
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../middleware.php';

$erro = '';

$stmtCursos = $pdo->query("SELECT id, titulo FROM cursos ORDER BY titulo ASC");
$cursos = $stmtCursos->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $curso_id = (int) ($_POST['curso_id'] ?? 0);
    $texto_botao = trim($_POST['texto_botao'] ?? 'Ver curso');
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    if ($titulo === '' || $descricao === '' || $curso_id <= 0) {
        $erro = 'Preencha todos os campos obrigatórios.';
    } elseif (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== 0) {
        $erro = 'Envie uma imagem.';
    } else {
        $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        if (!in_array($ext, $permitidas)) {
            $erro = 'Formato de imagem inválido.';
        } else {
            $pastaUpload = '../../assets/uploads/';
            if (!is_dir($pastaUpload)) {
                mkdir($pastaUpload, 0755, true);
            }

            $imagemNome = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES['imagem']['name']);
            $destino = $pastaUpload . $imagemNome;

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
                $sql = "INSERT INTO slideshow (titulo, descricao, imagem, curso_id, texto_botao, ativo)
                        VALUES (:titulo, :descricao, :imagem, :curso_id, :texto_botao, :ativo)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':titulo' => $titulo,
                    ':descricao' => $descricao,
                    ':imagem' => $imagemNome,
                    ':curso_id' => $curso_id,
                    ':texto_botao' => $texto_botao,
                    ':ativo' => $ativo
                ]);

                header('Location: listar.php?sucesso=1');
                exit;
            } else {
                $erro = 'Erro ao fazer upload da imagem.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Slide</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<div class="container" style="padding:40px 0;">
    <h1>Novo Slide</h1>

    <div style="margin:20px 0;">
        <a href="listar.php" class="btn" style="background:#555;">Voltar</a>
    </div>

    <?php if ($erro): ?>
        <p style="color:red;margin-bottom:20px;"><?php echo htmlspecialchars($erro); ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" style="background:#fff;padding:20px;">

        <div style="margin-bottom:15px;">
            <label>Título</label><br>
            <input type="text" name="titulo" style="width:100%;padding:10px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Descrição</label><br>
            <textarea name="descricao" rows="4" style="width:100%;padding:10px;"></textarea>
        </div>

        <div style="margin-bottom:15px;">
            <label>Curso vinculado</label><br>
            <select name="curso_id" style="width:100%;padding:10px;">
                <option value="">Selecione um curso</option>
                <?php foreach ($cursos as $curso): ?>
                    <option value="<?php echo $curso['id']; ?>">
                        <?php echo htmlspecialchars($curso['titulo']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="margin-bottom:15px;">
            <label>Texto do botão</label><br>
            <input type="text" name="texto_botao" value="Ver curso" style="width:100%;padding:10px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Imagem</label><br>
            <input type="file" name="imagem" accept="image/*">
        </div>

        <div style="margin-bottom:15px;">
            <label>
                <input type="checkbox" name="ativo" checked>
                Slide ativo
            </label>
        </div>

        <button type="submit" class="btn">Salvar</button>
    </form>
</div>
</body>
</html>