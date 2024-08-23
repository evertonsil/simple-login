function hideShowPassword() {
    let password = document.querySelector('#userpassLogin');
    let togglePassword = document.querySelector('#togglePassword');

    togglePassword.addEventListener('click', function () {
        //alterna o tipo do input se senha
        let type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        //alterna o ícone do input
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
}
hideShowPassword();

function verificaSenha(userpass, confirmUserpass) {
    if (userpass.val() !== confirmUserpass.val()) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "As senhas precisam ser iguais!"
        });
        return false;
    }
    return true;
}

function removeInputErrorClass(fields) {
    $(fields).removeClass('is-invalid');
}

$('#userpass, #confirmUserPass').on('change', function () {
    removeInputErrorClass('#userpass, #confirmUserPass');
});

//cadastro de novo usuário
$('#registerForm').on('submit', function (event) {
    event.preventDefault();

    if (verificaSenha($('#userpass'), $('#confirmUserpass'))) {
        const username = $('#username').val();
        const usermail = $('#usermail').val();
        const userpass = $('#userpass').val();

        if (username && usermail && userpass) {
            const baseUrl = 'http://localhost/simple-login';

            fetch(`${baseUrl}/api/users/register.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                //envia os dados como json
                body: JSON.stringify({
                    username: username,
                    email: usermail,
                    password: userpass
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        Swal.fire({
                            icon: "success",
                            title: "Parabéns",
                            text: "Você foi cadastrado com sucesso!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                console.log('clicked');
                                window.location.href = `${baseUrl}/index.php`;
                            }
                        });
                    }
                    else if (data.error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Algo deu errado!"
                        });
                        console.error(`Error ${data.error}`);
                    }
                })
                .catch(error => {
                    console.error('Error: ', error);
                    Swal.fire({
                        icon: "error",
                        title: "Oops",
                        text: 'Erro ao cadastrar usuário. Tente novamente mais tarde!'
                    });
                })
        }
        else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Preencha todos os campos!"
            });
        }
    }
    else {
        Swal.fire({
            icon: "error",
            title: "Oops",
            text: "As senhas digitadas são diferentes!"
        });
    }
})

//login usuário
$('#loginForm').on('submit', function (event) {
    event.preventDefault();

    const username = $('#usernameLogin').val();
    const userpass = $('#userpassLogin').val();

    if (username && userpass) {
        const baseUrl = 'http://localhost/simple-login';

        fetch(`${baseUrl}/api/users/login.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            //envia os dados como json
            body: JSON.stringify({
                username: username,
                password: userpass
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    console.log(data.token);
                    Swal.fire({
                        icon: "success",
                        title: "Parabéns",
                        text: "Login efetuado com sucesso!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                    localStorage.setItem('authToken', data.token);
                }
                else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Usuário ou senha incorretos. Por favor tente novamente!"
                    });
                    console.error(`Error ${data.error}`);
                }
            })
            .catch(error => {
                console.error('Error: ', error);
                Swal.fire({
                    icon: "error",
                    title: "Oops",
                    text: 'Erro ao realizar login. Tente novamente mais tarde!'
                });
            })
    }
    else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Preencha todos os campos!"
        });
    }
})