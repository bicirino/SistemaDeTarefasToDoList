<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function renderHeader($titulo_pagina) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?> - To-Do List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<?php if (isset($_SESSION["usuario_id"])): ?>
    <nav class="bg-blue-600 p-4 text-white shadow-md mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-xl font-bold">Minhas Tarefas</a>
            <div class="flex items-center gap-4">
                <span>Olá, <strong><?php echo $_SESSION["usuario"]; ?></strong></span>
                <a href="logout.php" class="bg-red-500 hover:bg-red-700 px-3 py-1 rounded text-sm transition">Sair</a>
            </div>
        </div>
    </nav>
<?php endif; ?>

<div class="container mx-auto px-4">
<?php
}

function renderFooter() {
?>
</div>
<footer class="text-center py-6 text-gray-500 text-sm">
    &copy; <?php echo date("Y"); ?> - Sistema de Tarefas
</footer>
</body>
</html>
<?php
}
?>