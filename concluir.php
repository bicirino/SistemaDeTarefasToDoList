<?php
session_start();
require_once "conexao.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("UPDATE tarefas SET status = 'concluida' WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$id, $_SESSION["usuario_id"]]);
}

header("Location: index.php");
exit;
?>