<?php require_once '../includes/functions.php';?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php include '../includes/header.php';?>
    <main>
    <h1>Entrar no Sistema</h1>
    <form action="" method="post">
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" required><br>
        <label for="senha">Senha: </label>
        <input type="password" name="senha" id="senha" required><br><br>
        <input type="submit" value="Entrar">
    </form>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $user = consulta_user($conexao, $_POST['email']);
        if ($user && $user['senha'] == $_POST['senha']) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['usuario'] = $user['email'];
            header("Location: /pokestore/index.php");
            exit();
        } else {
            echo "Email ou senha incorretos!";
        }
    }
    ?>
    </main>
    <?php include '../includes/footer.php';?>
</body>
</html>