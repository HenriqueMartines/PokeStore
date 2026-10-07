<?php

session_start();

include '../config/conexao.php';

if (isset($_POST['entrar'])) {

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios
            WHERE usuario = '$usuario'
            AND senha = '$senha'";

    $resultado = pg_query($conn, $sql);

    if (pg_num_rows($resultado) > 0) {

        $dados = pg_fetch_assoc($resultado);

        $_SESSION['usuario'] = $dados['usuario'];
        $_SESSION['tipo'] = $dados['tipo'];

        if ($dados['tipo'] == 'admin') {

            header("Location: ../admin/index.php");

        } else {

            header("Location: ../index.php");

        }

        exit;

    } else {

        $mensagem = "Usuario ou senha incorretos.";

    }

}

?>

<?php include '../includes/header.php'; ?>

<h2>Login</h2>

<?php

if (isset($mensagem)) {

    echo "<p>$mensagem</p>";

}

?>

<form method="POST">

    <label>Usuario:</label>

    <input type="text" name="usuario">

    <label>Senha:</label>

    <input type="password" name="senha">

    <button type="submit" name="entrar">
        Entrar
    </button>

</form>

<?php include '../includes/footer.php'; ?>