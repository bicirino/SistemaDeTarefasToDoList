<?php
    $host = "localhost:3306";
    $db = "tarefas";
    $user = "root"; 
    $porta = "3306";
    $password = "ceub123456";
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }
    
?> 