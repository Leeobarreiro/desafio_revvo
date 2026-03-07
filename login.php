<?php
require_once 'config/config.php';
require_once 'config/database.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuarioNome = trim($_POST['usuario'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($usuarioNome === '' || $senha === '') {
        $erro = 'Preencha usuário e senha.';
    } else {

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1");
        $stmt->execute([':usuario' => $usuarioNome]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];

            if ($usuario['tipo'] === 'admin') {
                header('Location: admin/index.php');
            } else {
                header('Location: index.php');
            }

            exit;

        } else {
            $erro = 'Usuário ou senha inválidos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="container" style="padding: 40px 0; max-width: 500px;">
<div style="background:#fff; padding:24px; border-radius:8px;">

<h1 style="margin-bottom:20px;">Entrar</h1>

<?php if ($erro): ?>
<p style="color:red; margin-bottom:20px;">
<?php echo htmlspecialchars($erro); ?>
</p>
<?php endif; ?>

<form method="POST">

<div style="margin-bottom:15px;">
<label>Usuário</label><br>
<input
type="text"
name="usuario"
style="width:100%; padding:10px;"
required
>
</div>

<div style="margin-bottom:15px;">
<label>Senha</label><br>
<input
type="password"
name="senha"
style="width:100%; padding:10px;"
required
>
</div>

<button type="submit" class="btn">
Entrar
</button>

</form>

<p style="margin-top:20px;">
Não tem conta?
<a href="cadastro.php">Cadastre-se</a>
</p>

</div>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>