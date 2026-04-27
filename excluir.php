<?php
session_start();
require_once "conexao.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$id, $_SESSION["usuario_id"]]);
}

header("Location: index.php");
exit;
?>