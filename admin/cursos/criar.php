<?php
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../middleware.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');

    if ($titulo === '' || $descricao === '') {
        $erro = 'Preencha todos os campos.';
    } elseif (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== 0) {
        $erro = 'Envie uma imagem válida.';
    } else {

        // valida extensão
        $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg','jpeg','png','webp','gif'];

        if (!in_array($ext, $permitidas)) {
            $erro = 'Formato de imagem inválido.';
        } else {

            // garante pasta de uploads
            $pastaUpload = '../../assets/uploads/';
            if (!is_dir($pastaUpload)) {
                mkdir($pastaUpload, 0755, true);
            }

            $imagemNome = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/','', $_FILES['imagem']['name']);
            $destino = $pastaUpload . $imagemNome;

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {

                $sql = "INSERT INTO cursos (titulo, descricao, imagem)
                        VALUES (:titulo, :descricao, :imagem)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':titulo' => $titulo,
                    ':descricao' => $descricao,
                    ':imagem' => $imagemNome
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
<title>Criar Curso</title>
<link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

<div class="container" style="padding:40px 0;">
    <h1>Cadastrar Curso</h1>

    <div style="margin:20px 0;">
        <a href="listar.php" class="btn" style="background:#555;">Voltar</a>
    </div>

    <?php if ($erro): ?>
        <p style="color:red;margin-bottom:20px;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data" style="background:#fff;padding:20px;">

        <div style="margin-bottom:15px;">
            <label>Título</label><br>
            <input type="text" name="titulo" style="width:100%;padding:10px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Descrição</label><br>
            <textarea name="descricao" rows="5" style="width:100%;padding:10px;"></textarea>
        </div>

        <div style="margin-bottom:15px;">
            <label>Imagem</label><br>
            <input type="file" name="imagem" accept="image/*">
        </div>

        <button type="submit" class="btn">Salvar Curso</button>

    </form>
</div>

</body>
</html>