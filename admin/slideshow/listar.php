<?php
require_once '../../config/config.php';
require_once '../../config/database.php';

$stmt = $pdo->query("SELECT * FROM slideshow ORDER BY id DESC");
$slides = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
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

<table border="1" cellpadding="10" width="100%" style="background:#fff;">

<thead>
<tr>
<th>ID</th>
<th>Imagem</th>
<th>Título</th>
<th>Status</th>
<th>Ações</th>
</tr>
</thead>

<tbody>

<?php foreach ($slides as $slide): ?>

<tr>

<td><?php echo $slide['id']; ?></td>

<td>
<img src="../../assets/uploads/<?php echo $slide['imagem']; ?>" width="120">
</td>

<td><?php echo htmlspecialchars($slide['titulo']); ?></td>

<td>
<?php echo $slide['ativo'] ? 'Ativo' : 'Inativo'; ?>
</td>

<td>
<a href="editar.php?id=<?php echo $slide['id']; ?>">Editar</a> |
<a href="excluir.php?id=<?php echo $slide['id']; ?>" onclick="return confirm('Excluir slide?')">Excluir</a>
</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</body>
</html>