<?php require_once('header.php'); ?>

<body>
    <section class="container">
        <div class="card p-4 m-4 shadow-lg">
            <div class="card-body">
                <form id="registerForm" method="POST" oninput='confirmUserpass.setCustomValidity(confirmUserpass.value != userpass.value ? "As senhas não coincidem." : "")'>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="username" id="username"
                            placeholder="Nome de Usuário" required>
                        <label for="username">Nome de usuário</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="usermail" id="usermail" placeholder="E-mail"
                            required>
                        <label for="usermail">E-mail</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="userpass" id="userpass" placeholder="Senha"
                            required>
                        <label for="userpass">Senha</label>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"
                            id="togglePassword"></i>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="confirmUserpass" placeholder="Confirmar Senha"
                            required>
                        <label for="confirmUserpass">Confirmar Senha</label>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">CADASTRAR</button>
                    </div>
                </form>
                <div class="mt-3">
                    <a href="index.php" class="card-link">Já possui uma conta? Clique para entrar!</a>
                </div>
            </div>
        </div>
    </section>
</body>

<?php require_once('footer.php'); ?>

</html>