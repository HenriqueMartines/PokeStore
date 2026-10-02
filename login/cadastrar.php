<?php require_once '../includes/functions.php';?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
</head>
<body>
    <?php include '../includes/header.php';?>
    <main>
    <h1>Cadastrar Usuário</h1>
    <form action="" method="post">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" required><br>

        <label for="email">Email: </label>
        <input type="email" name="email" id="email" required><br>

        <label for="senha">Senha: </label>
        <input type="password" name="senha" id="senha" required><br><br>

        <input type="submit" value="Cadastrar">
        <input type="reset" value="Limpar">
    </form>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        cadastrar_user($conexao, $_POST['nome'], $_POST['email'], $_POST['senha']);
    }
    ?>

    </main>
    <?php include '../includes/footer.php';?>
</body>
</html>