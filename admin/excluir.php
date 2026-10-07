<?php

session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {

    header("Location: ../login/login.php");

    exit;

}

include '../config/conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM produtos
        WHERE id = $id";

pg_query($conn, $sql);

header("Location: index.php");

exit;

?>