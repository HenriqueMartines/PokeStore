<?php
session_start();

include '../config/conexao.php';
include '../includes/functions.php';

if (isset($_POST['entrar'])) {

    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    $dados = consulta_user($conexao, $usuario);

    if ($dados && trim($dados['senha']) === $senha) {

        $_SESSION['usuario'] = $dados['usuario'];
        $_SESSION['tipo'] = $dados['tipo'];

        if ($dados['tipo'] == 'admin') {
            header("Location: ../admin/index.php");
        } else {
            header("Location: ../index.php");
        }
        exit;

    } else {
        $mensagem = "Utilizador ou palavra-passe incorretos.";
    }
}
?>

<?php include '../includes/header.php'; ?>

<h2>Login</h2>

<?php
if (isset($_GET['sucesso'])) {
    echo "<p style='color: green;'>Registo realizado com sucesso! Faça login abaixo.</p>";
}

if (isset($mensagem)) {
    echo "<p style='color: red;'>$mensagem</p>";
}
?>

<form method="POST">
    <label>Utilizador:</label>
    <input type="text" name="usuario" required>

    <label>Palavra-passe:</label>
    <input type="password" name="senha" required>

    <button type="submit" name="entrar">
        Entrar
    </button>

    <p style="margin-top: 15px;">
        Ainda não tem conta? <a href="cadastrar.php">Registe-se aqui</a>.
    </p>
</form>

<?php include '../includes/footer.php'; ?>