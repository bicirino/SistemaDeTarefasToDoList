<?php

$host = "localhost";
$port = 3306;
$db = "tarefas";
$user = "root";
$password = "ceub123456";

try {
    
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>