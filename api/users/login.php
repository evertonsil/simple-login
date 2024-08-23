<?php
header('Content-Type: application/json');

//inicializando sessão
session_start();

// puxando o arquivo de configuração do banco
require_once('../../database.php');

// validação do método aceito para esse endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //recebe e armazena os dados enviados como json e decodifica em um array associativo
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['username']) && isset($data['password'])) {
        //recebe os dados caso  estejam presentes
        $username = $data['username'];
        $password = $data['password'];

        try {
            //verifica se o usuário está cadastrado no banco de dados
            $sql = $pdo->prepare('SELECT * FROM users WHERE username = :username');
            $sql->bindParam(':username', $username);
            $sql->execute();

            $result = $sql->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($password, $result['password'])) {
                //gerando um token de autenticação simples
                $token = bin2hex(random_bytes(16));

                //salvando o token no banco de dados
                $sql = $pdo->prepare('UPDATE users SET token = :token WHERE id = :id');
                $sql->bindParam(':token', $token);
                $sql->bindParam(':id', $user['id']);
                $sql->execute();

                //retorna um sessão com os dados do usuário logado
                $_SESSION['loggedUser'] = $result;

                //retorna um array associativo com mensagem de sucesso e token gerado
                echo json_encode(['message' => 'Login successful', "token" => $token]);
            } else {
                echo json_encode(['error' => 'Invalid username or password']);
            }
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Failed to login: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Please fill all fields']);
    }
} else {
    echo json_encode(['error' => 'Invalid method.  Only POST is allowed.']);
}
