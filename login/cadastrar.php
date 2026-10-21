<?php
session_start();

include '../config/conexao.php';
include '../includes/functions.php';

$mensagem = "";

if (isset($_POST['cadastrar'])) {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $tipo = 'cliente'; // Todo novo cadastro pelo site é do tipo 'cliente'

    if (!empty($usuario) && is_string($senha) && $senha !== '') {
        // Verifica se o usuário já existe
        $usuarioExistente = consulta_user($conexao, $usuario);

        if ($usuarioExistente) {
            $mensagem = "Este nome de usuário já está em uso. Escolha outro.";
        } else {
            // Cadastra o novo usuário
            cadastrar_user($conexao, $usuario, $senha, $tipo);
            header("Location: login.php?sucesso=1");
            exit;
        }
    } else {
        $mensagem = "Preencha todos os campos!";
    }
}
?>

<?php include '../includes/header.php'; ?>

<h2>Criar Conta</h2>

<?php if (!empty($mensagem)): ?>
    <p style="color: red;"><?php echo html_escape($mensagem); ?></p>
<?php endif; ?>

<form method="POST">
    <label>Usuário:</label>
    <input type="text" name="usuario" required>

    <label>Senha:</label>
    <input type="password" name="senha" required>

    <button type="submit" name="cadastrar">
        Cadastrar
    </button>

    <p style="margin-top: 15px;">
        Já tem uma conta? <a href="login.php">Faça login aqui</a>.
    </p>
</form>

<?php include '../includes/footer.php'; ?>