<?php

$host = 'localhost';
$db_name = 'mybase';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:dbname=$db_name;host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro na conexão: ' . $e->getMessage());
}
