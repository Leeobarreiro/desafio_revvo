<?php
require_once '../../config/config.php';
require_once '../../config/database.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$titulo = trim($_POST['titulo'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$link_botao = trim($_POST['link_botao'] ?? '');
$texto_botao = trim($_POST['texto_botao'] ?? 'Ver curso');
$ativo = isset($_POST['ativo']) ? 1 : 0;

if ($titulo === '' || $descricao === '' || $link_botao === '') {
$erro = 'Preencha todos os campos.';
}
elseif (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== 0) {
$erro = 'Envie uma imagem.';
}
else {

$imagemNome = time().'_'.$_FILES['imagem']['name'];
$destino = '../../assets/uploads/'.$imagemNome;

move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);

$sql = "INSERT INTO slideshow
(titulo, descricao, imagem, link_botao, texto_botao, ativo)
VALUES (:titulo,:descricao,:imagem,:link,:texto,:ativo)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
':titulo'=>$titulo,
':descricao'=>$descricao,
':imagem'=>$imagemNome,
':link'=>$link_botao,
':texto'=>$texto_botao,
':ativo'=>$ativo
]);

header('Location:listar.php');
exit;

}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Novo Slide</title>
<link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

<div class="container" style="padding:40px 0;">

<h1>Novo Slide</h1>

<form method="POST" enctype="multipart/form-data" style="background:#fff;padding:20px;">

<label>Título</label>
<input type="text" name="titulo" style="width:100%;padding:10px">

<br><br>

<label>Descrição</label>
<textarea name="descricao" rows="4" style="width:100%;padding:10px"></textarea>

<br><br>

<label>Link do botão</label>
<input type="text" name="link_botao" style="width:100%;padding:10px">

<br><br>

<label>Texto do botão</label>
<input type="text" name="texto_botao" value="Ver curso" style="width:100%;padding:10px">

<br><br>

<label>Imagem</label>
<input type="file" name="imagem">

<br><br>

<label>
<input type="checkbox" name="ativo" checked>
Ativo
</label>

<br><br>

<button class="btn">Salvar</button>

</form>

</div>

</body>
</html>