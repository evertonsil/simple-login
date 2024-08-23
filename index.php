<?php require_once('header.php');

session_start();

if (isset($_SESSION['loggedUser'])): ?>
    <div class="userInfos">
        <p>Nome de usuário: <?php echo $_SESSION['loggedUser']['username']; ?></p>
        <p>Email: <?php echo $_SESSION['loggedUser']['email']; ?></p>
    </div>
<?php else: ?>
    <div class="userInfos">
        <p>Usuário não logado</p>
    </div>
<?php endif; ?>


<body>
    <section class="container">
        <div class="card p-4 m-4 shadow-lg">
            <div class="card-body">
                <form id="loginForm">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="usernameLogin" id="usernameLogin" placeholder="Nome de Usuário" value="<?php echo $_SESSION['loggedUser']['username'] ?? ''; ?>" <?php echo isset($_SESSION['loggedUser']) ? 'disabled' : ''; ?> required>
                        <label for="username">Nome de usuário</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="userpassLogin" id="userpassLogin" placeholder="Senha" value="<?php echo $_SESSION['loggedUser']['password'] ?? ''; ?>" <?php echo isset($_SESSION['loggedUser']) ? 'disabled' : ''; ?> required>
                        <label for="userpass">Senha</label>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer" id="togglePassword"></i>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">ENTRAR</button>
                    </div>
                </form>
                <div class="mt-3">
                    <a href="register.php" class="card-link">Não possuí uma conta? Registre-se!</a>
                </div>
                <div class="mt-3 justify-content-md-end d-md-flex">
                    <a href="logout.php">
                        <button type="button" class="btn btn-danger">Sair</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
</body>

<?php require_once('footer.php'); ?>

</html>