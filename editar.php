<?php
require_once "conexao.php";
require_once "layout.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $_SESSION["usuario_id"]]);
$tarefa = $stmt->fetch();

if (!$tarefa) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $status = $_POST["status"];

    $update = $pdo->prepare("UPDATE tarefas SET titulo = ?, descricao = ?, status = ? WHERE id = ?");
    $update->execute([$titulo, $descricao, $status, $id]);

    header("Location: index.php");
    exit;
}

renderHeader("Editar Tarefa");
?>

<div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Tarefa</h2>
    
    <form method="POST">
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Título</label>
            <input type="text" name="titulo" value="<?php echo htmlspecialchars($tarefa['titulo']); ?>" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Descrição</label>
            <textarea name="descricao" rows="4" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($tarefa['descricao']); ?></textarea>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Status</label>
            <select name="status" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="pendente" <?php if($tarefa['status'] == 'pendente') echo 'selected'; ?>>Pendente</option>
                <option value="concluida" <?php if($tarefa['status'] == 'concluida') echo 'selected'; ?>>Concluída</option>
            </select>
        </div>
        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700 transition">Salvar Alterações</button>
            <a href="index.php" class="text-gray-600 hover:text-gray-900 transition">Cancelar</a>
        </div>
    </form>
</div>

<?php renderFooter(); ?>