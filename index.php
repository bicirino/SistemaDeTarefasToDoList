<?php
require_once "conexao.php";
require_once "layout.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar sessao no inicio
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

// Buscar tarefas (como não há FK, listamos todas)
$stmt = $pdo->query("SELECT * FROM tarefas ORDER BY id DESC");
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

renderHeader("Lista de Tarefas");
?>

<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tarefas</h2>
        <a href="nova.php" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition">
            + Nova Tarefa
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="p-3 border-b border-gray-300">Título</th>
                    <th class="p-3 border-b border-gray-300 text-center">Status</th>
                    <th class="p-3 border-b border-gray-300">Data de Criação</th>
                    <th class="p-3 border-b border-gray-300 text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($tarefas) > 0): ?>
                    <?php foreach ($tarefas as $t): ?>
                        <tr class="hover:bg-gray-50 border-b border-gray-200">
                            <td class="p-3 font-medium text-gray-800"><?php echo htmlspecialchars($t['titulo']); ?></td>
                            <td class="p-3 text-center">
                                <?php if ($t['status'] === 'concluida'): ?>
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold uppercase">Concluída</span>
                                <?php else: ?>
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold uppercase">Pendente</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3 text-gray-500 text-sm">-</td> <td class="p-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="editar.php?id=<?php echo $t['id']; ?>" class="bg-blue-500 text-white px-2 py-1 rounded text-sm hover:bg-blue-600 transition">Editar</a>
                                    <a href="concluir.php?id=<?php echo $t['id']; ?>" class="bg-teal-500 text-white px-2 py-1 rounded text-sm hover:bg-teal-600 transition">Concluir</a>
                                    <a href="excluir.php?id=<?php echo $t['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600 transition">Excluir</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">Nenhuma tarefa encontrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php renderFooter(); ?>