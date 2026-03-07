<header class="header">
    <div class="container header-content">
        <div class="logo">
            <a href="index.php" style="text-decoration:none; color:inherit;">Nada aqui</a>
        </div>

        <div class="header-search">
            <input type="text" placeholder="Pesquisar cursos...">
        </div>

        <div class="header-user">
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <span style="margin-right:10px;">
                    Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
                </span>

                <?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
                    <a href="admin/index.php" class="btn" style="margin-right:8px;">Painel</a>
                <?php endif; ?>

                <a href="logout.php" class="btn" style="background:#555;">Sair</a>
            <?php else: ?>
                <a href="login.php" class="btn" style="margin-right:8px;">Entrar</a>
                <a href="cadastro.php" class="btn" style="background:#555;">Cadastrar</a>
            <?php endif; ?>
        </div>
    </div>
</header>