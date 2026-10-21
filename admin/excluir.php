<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {
    header("Location: ../login/login.php");
    exit;
}

include '../config/conexao.php';
include '../includes/functions.php'; // Incluído para usar apagar_produto()

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1 || !validar_csrf_token($_POST['csrf_token'] ?? null)) {
    http_response_code(400);
    exit('Solicitação inválida.');
}

apagar_produto($conexao, $id);

header("Location: index.php");
exit;
?>