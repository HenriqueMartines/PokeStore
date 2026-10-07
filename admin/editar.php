<?php

session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {

    header("Location: ../login/login.php");

    exit;

}

include '../config/conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM produtos WHERE id = $id";

$resultado = pg_query($conn, $sql);

$produto = pg_fetch_assoc($resultado);

if (isset($_POST['editar'])) {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $sql = "UPDATE produtos SET
            nome = '$nome',
            descricao = '$descricao',
            preco = '$preco',
            quantidade = '$quantidade'
            WHERE id = $id";

    pg_query($conn, $sql);

    header("Location: index.php");

    exit;

}

?>

<?php include '../includes/header.php'; ?>

<h2>Editar produto</h2>

<form method="POST">

    <label>Nome:</label>

    <input
        type="text"
        name="nome"
        value="<?php echo $produto['nome']; ?>"
    >

    <label>Descrição:</label>

    <input
        type="text"
        name="descricao"
        value="<?php echo $produto['descricao']; ?>"
    >

    <label>Preço:</label>

    <input
        type="text"
        name="preco"
        value="<?php echo $produto['preco']; ?>"
    >

    <label>Quantidade:</label>

    <input
        type="number"
        name="quantidade"
        value="<?php echo $produto['quantidade']; ?>"
    >

    <button type="submit" name="editar">
        Salvar
    </button>

</form>

<?php include '../includes/footer.php'; ?>