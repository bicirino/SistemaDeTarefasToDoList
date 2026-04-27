<?php
require_once "conexao.php";
require_once "layout.php";

// Verificar sessao
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

// Ao receber POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST["titulo"]);
    $descricao = trim($_POST["descricao"]);

    if (!empty($titulo)) {
        // Inserção com o campo usuario_id
        $stmt = $pdo->prepare("INSERT INTO tarefas (titulo, descricao, usuario_id) VALUES (?, ?, ?)");
        $stmt->execute([$titulo, $descricao, $_SESSION["usuario_id"]]);
        
        header("Location: index.php");
        exit;
    }
}

renderHeader("Nova Tarefa");
?>

<div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Adicionar Nova Tarefa</h2>
    
    <form method="POST">
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Título (Obrigatório)</label>
            <input type="text" name="titulo" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Descrição</label>
            <textarea name="descricao" rows="4" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700 transition">Salvar</button>
            <a href="index.php" class="text-gray-600 hover:text-gray-900 transition">Cancelar</a>
        </div>
    </form>
</div>

<?php renderFooter(); ?>