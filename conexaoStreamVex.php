<?php

$host = 'localhost';
$db = 'streamvex';
$user = 'root'; // ou o seu usuário do MySQL
$pass = '';     // ou a sua senha, se tiver

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo 'Conexão realizada com total sucesso, meu amigo!';
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}

?>