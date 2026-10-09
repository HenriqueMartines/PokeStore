<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {
    header("Location: ../login/login.php");
    exit;
}

include '../config/conexao.php';
include '../includes/functions.php'; // Incluído para usar apagar_produto()

$id = $_GET['id'];

apagar_produto($conexao, $id);

header("Location: index.php");
exit;
?>