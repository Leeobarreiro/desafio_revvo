<header class="header">

    <div class="container header-content">

        <div class="logo">
            <a href="index.php">
                LEO
            </a>
        </div>

        <div class="header-search">
            <input
                type="text"
                placeholder="Pesquisar cursos..."
            >
        </div>

        <div class="header-user">

            <?php if (isset($_SESSION['usuario_id'])): ?>

                <span class="user-welcome">
                    Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
                </span>

                <?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
                    <a href="admin/index.php" class="btn">
                        Painel
                    </a>
                <?php endif; ?>

                <a href="logout.php" class="btn btn-dark">
                    Sair
                </a>

            <?php else: ?>

                <a href="login.php" class="btn">
                    Entrar
                </a>

                <a href="cadastro.php" class="btn btn-dark">
                    Cadastrar
                </a>

            <?php endif; ?>

        </div>

    </div>

</header>