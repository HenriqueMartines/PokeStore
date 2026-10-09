<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {
    header("Location: ../login/login.php");
    exit;
}

include '../config/conexao.php';
include '../includes/functions.php'; // Incluído para usar consultar_produto() e atualizar_produto()

$id = $_GET['id'];
$produto = consultar_produto($conexao, $id);

if (isset($_POST['editar'])) {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    atualizar_produto($conexao, $id, $nome, $descricao, $preco, $quantidade);

    header("Location: index.php");
    exit;
}

?>

<?php include '../includes/header.php'; ?>

<h2>Editar produto</h2>

<form method="POST">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($produto['nome'] ?? ''); ?>">

    <label>Descrição:</label>
    <input type="text" name="descricao" value="<?php echo htmlspecialchars($produto['descricao'] ?? ''); ?>">

    <label>Preço:</label>
    <input type="text" name="preco" value="<?php echo htmlspecialchars($produto['preco'] ?? ''); ?>">

    <label>Quantidade:</label>
    <input type="number" name="quantidade" value="<?php echo htmlspecialchars($produto['quantidade'] ?? ''); ?>">

    <button type="submit" name="editar">
        Salvar
    </button>
</form>

<?php include '../includes/footer.php'; ?>