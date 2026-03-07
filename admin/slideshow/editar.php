<?php
require_once '../../config/config.php';
require_once '../../config/database.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM slideshow WHERE id = :id");
$stmt->execute([':id' => $id]);
$slide = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$slide) {
    die('Slide não encontrado.');
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $link_botao = trim($_POST['link_botao'] ?? '');
    $texto_botao = trim($_POST['texto_botao'] ?? 'Ver mais');
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    if ($titulo === '' || $descricao === '' || $link_botao === '') {
        $erro = 'Preencha todos os campos obrigatórios.';
    } else {

        $imagemNome = $slide['imagem'];

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {

            $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
            $permitidas = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

            if (!in_array($ext, $permitidas)) {
                $erro = 'Formato de imagem inválido.';
            } else {

                $pastaUpload = '../../assets/uploads/';

                if (!is_dir($pastaUpload)) {
                    mkdir($pastaUpload, 0755, true);
                }

                $novoNomeImagem = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES['imagem']['name']);
                $destino = $pastaUpload . $novoNomeImagem;

                if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {

                    if (!empty($slide['imagem'])) {
                        $imagemAntiga = $pastaUpload . $slide['imagem'];

                        if (file_exists($imagemAntiga)) {
                            unlink($imagemAntiga);
                        }
                    }

                    $imagemNome = $novoNomeImagem;
                } else {
                    $erro = 'Erro ao enviar a nova imagem.';
                }
            }
        }

        if ($erro === '') {

            $sql = "UPDATE slideshow
                    SET titulo = :titulo,
                        descricao = :descricao,
                        imagem = :imagem,
                        link_botao = :link,
                        texto_botao = :texto,
                        ativo = :ativo
                    WHERE id = :id";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':titulo' => $titulo,
                ':descricao' => $descricao,
                ':imagem' => $imagemNome,
                ':link' => $link_botao,
                ':texto' => $texto_botao,
                ':ativo' => $ativo,
                ':id' => $id
            ]);

            header('Location: listar.php?sucesso=1');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Slide</title>
<link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<div class="container" style="padding:40px 0;">

<h1>Editar Slide</h1>

<div style="margin:20px 0;">
<a href="listar.php" class="btn" style="background:#555;">Voltar</a>
</div>

<?php if ($erro): ?>
<p style="color:red;margin-bottom:20px;">
<?php echo htmlspecialchars($erro); ?>
</p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" style="background:#fff;padding:20px;">

<div style="margin-bottom:15px;">
<label>Título</label><br>
<input
type="text"
name="titulo"
value="<?php echo htmlspecialchars($slide['titulo']); ?>"
style="width:100%;padding:10px;"
>
</div>

<div style="margin-bottom:15px;">
<label>Descrição</label><br>
<textarea
name="descricao"
rows="4"
style="width:100%;padding:10px;"
><?php echo htmlspecialchars($slide['descricao']); ?></textarea>
</div>

<div style="margin-bottom:15px;">
<label>Link do botão</label><br>
<input
type="text"
name="link_botao"
value="<?php echo htmlspecialchars($slide['link_botao']); ?>"
style="width:100%;padding:10px;"
>
</div>

<div style="margin-bottom:15px;">
<label>Texto do botão</label><br>
<input
type="text"
name="texto_botao"
value="<?php echo htmlspecialchars($slide['texto_botao']); ?>"
style="width:100%;padding:10px;"
>
</div>

<div style="margin-bottom:15px;">
<label>Imagem atual</label><br>
<img
src="../../assets/uploads/<?php echo htmlspecialchars($slide['imagem']); ?>"
width="200"
alt="<?php echo htmlspecialchars($slide['titulo']); ?>"
>
</div>

<div style="margin-bottom:15px;">
<label>Nova imagem</label><br>
<input type="file" name="imagem" accept="image/*">
</div>

<div style="margin-bottom:15px;">
<label>
<input
type="checkbox"
name="ativo"
<?php if ($slide['ativo']) echo 'checked'; ?>
>
Slide ativo
</label>
</div>

<button type="submit" class="btn">Atualizar Slide</button>

</form>

</div>

</body>
</html>