<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {
    header("Location: ../login/login.php");
    exit;
}

include '../config/conexao.php';
include '../includes/functions.php'; // Incluído para usar consultar_produto() e atualizar_produto()

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header("Location: index.php");
    exit;
}

$produto = consultar_produto($conexao, $id);
if (!$produto) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {

    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco = $_POST['preco'] ?? '';
    $quantidade = filter_var($_POST['quantidade'] ?? null, FILTER_VALIDATE_INT);

    if (!validar_csrf_token($_POST['csrf_token'] ?? null)) {
        $erro = "A solicitação expirou. Atualize a página e tente novamente.";
    } elseif ($nome === '' || !is_numeric($preco) || (float) $preco < 0 || $quantidade === false || $quantidade < 0) {
        $erro = "Informe nome, preço válido e quantidade não negativa.";
    } else {
        atualizar_produto($conexao, $id, $nome, $descricao, $preco, $quantidade);

        header("Location: index.php");
        exit;
    }

}

?>

<?php include '../includes/header.php'; ?>

<h2>Editar produto</h2>

<?php if (isset($erro)): ?>
    <p style="color: red;"><?php echo html_escape($erro); ?></p>
<?php endif; ?>

<form method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo html_escape(csrf_token()); ?>">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?php echo html_escape($produto['nome']); ?>">

    <label>Descrição:</label>
    <input type="text" name="descricao" value="<?php echo html_escape($produto['descricao']); ?>">

    <label>Preço:</label>
    <input type="text" name="preco" value="<?php echo html_escape($produto['preco']); ?>">

    <label>Quantidade:</label>
    <input type="number" name="quantidade" value="<?php echo (int) $produto['quantidade']; ?>">

    <button type="submit" name="editar">
        Salvar
    </button>
</form>

<?php include '../includes/footer.php'; ?>