<?php
require_once 'config/config.php';
require_once 'config/database.php';

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST['confirmar_senha'] ?? '';

    if ($nome === '' || $usuario === '' || $email === '' || $senha === '' || $confirmarSenha === '') {
        $erro = 'Preencha todos os campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Informe um e-mail válido.';
    } elseif ($senha !== $confirmarSenha) {
        $erro = 'As senhas não coincidem.';
    } elseif (strlen($senha) < 6) {
        $erro = 'A senha deve ter pelo menos 6 caracteres.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = :usuario OR email = :email LIMIT 1");
        $stmt->execute([
            ':usuario' => $usuario,
            ':email' => $email
        ]);
        $existe = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existe) {
            $erro = 'Já existe um usuário ou e-mail cadastrado.';
        } else {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
                INSERT INTO usuarios (nome, usuario, email, senha, tipo)
                VALUES (:nome, :usuario, :email, :senha, 'usuario')
            ");

            $stmt->execute([
                ':nome' => $nome,
                ':usuario' => $usuario,
                ':email' => $email,
                ':senha' => $senhaHash
            ]);

            $sucesso = 'Cadastro realizado com sucesso. Agora você pode entrar.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Desafio Revvo</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="container" style="padding: 40px 0; max-width: 500px;">
    <div style="background:#fff; padding:24px; border-radius:8px;">
        <h1 style="margin-bottom:20px;">Criar conta</h1>

        <?php if ($erro): ?>
            <p style="color:red; margin-bottom:20px;"><?php echo htmlspecialchars($erro); ?></p>
        <?php endif; ?>

        <?php if ($sucesso): ?>
            <p style="color:green; margin-bottom:20px;"><?php echo htmlspecialchars($sucesso); ?></p>
        <?php endif; ?>

        <form method="POST">
            <div style="margin-bottom:15px;">
                <label>Nome completo</label><br>
                <input type="text" name="nome" style="width:100%; padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Nome de usuário</label><br>
                <input type="text" name="usuario" style="width:100%; padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>E-mail</label><br>
                <input type="email" name="email" style="width:100%; padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Senha</label><br>
                <input type="password" name="senha" style="width:100%; padding:10px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Confirmar senha</label><br>
                <input type="password" name="confirmar_senha" style="width:100%; padding:10px;">
            </div>

            <button type="submit" class="btn">Cadastrar</button>
        </form>

        <p style="margin-top:20px;">
            Já tem conta?
            <a href="login.php">Entrar</a>
        </p>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>