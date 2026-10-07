<?php

session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {

    header("Location: ../login/login.php");

    exit;

}

include '../config/conexao.php';

if (isset($_POST['cadastrar'])) {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $imagem = $_FILES['imagem']['name'];

    move_uploaded_file(
        $_FILES['imagem']['tmp_name'],
        "../imagens/" . $imagem
    );

    $sql = "INSERT INTO produtos
            (nome, descricao, preco, quantidade, imagem)
            VALUES
            ('$nome', '$descricao', '$preco', '$quantidade', '$imagem')";

    pg_query($conn, $sql);

    header("Location: index.php");

    exit;

}

?>

<?php include '../includes/header.php'; ?>

<h2>Adicionar produto</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Nome:</label>

    <input type="text" name="nome">

    <label>Descrição:</label>

    <input type="text" name="descricao">

    <label>Preço:</label>

    <input type="text" name="preco">

    <label>Quantidade:</label>

    <input type="number" name="quantidade">

    <label>Imagem:</label>

    <input type="file" name="imagem">

    <button type="submit" name="cadastrar">
        Cadastrar
    </button>

</form>

<?php include '../includes/footer.php'; ?>