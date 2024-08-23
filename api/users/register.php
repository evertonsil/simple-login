<?php
header('Content-Type: application/json');

// puxando o arquivo de configuração do banco
require_once('../../database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //recebe e armazena os dados enviados como json
    $data = file_get_contents('php://input');

    //decodifica o json em array associativo
    $data = json_decode($data, true);

    $username = $data['username'];
    $usermail = $data['email'];
    $userpass = password_hash($data['password'],  PASSWORD_DEFAULT);

    try {
        $sql = $pdo->prepare('INSERT INTO users (username, email, password, ativo) VALUES (:username, :email, :password, 1)');
        $sql->bindParam(':username', $username);
        $sql->bindParam(':email', $usermail);
        $sql->bindParam(':password', $userpass);
        $sql->execute();

        //resposta em um array associativo
        echo json_encode(['message' => 'User registered successfully']);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Failed to register user: " . $e->getMessage()]);
    }
} else {
    //resposta de erro em um array associativo
    echo json_encode(['error' => 'Invalid method.  Only POST is allowed.']);
}
