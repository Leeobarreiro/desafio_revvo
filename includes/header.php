<header class="header">
    <div class="container header-content">

    <div class="logo">
        <a href="index.php">
            <img src="assets/images/logo.png" alt="LEO Learning">
        </a>
    </div>

        <div class="header-search">
            <input
                type="text"
                placeholder="Pesquisar cursos..."
            >
            <span class="search-icon">&#128269;</span>
        </div>

        <div class="header-user">
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <div class="user-menu">

                    <button type="button" class="user-profile" id="userMenuButton">
                        <div class="user-avatar">
                            <img src="assets/images/avatar-default.png" alt="Usuário">
                        </div>

                        <div class="user-info">
                            <span class="user-welcome-text">Seja bem-vindo</span>
                            <strong class="user-name">
                                <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
                            </strong>
                        </div>

                        <span class="user-arrow">&#9662;</span>
                    </button>

                    <div class="user-dropdown" id="userDropdown">
                        <?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
                            <a href="admin/index.php">Painel</a>
                        <?php endif; ?>

                        <a href="logout.php">Sair</a>
                    </div>

                </div>
            <?php else: ?>
                <div class="header-auth">
                    <a href="login.php" class="btn">Entrar</a>
                    <a href="cadastro.php" class="btn btn-dark">Cadastrar</a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</header>