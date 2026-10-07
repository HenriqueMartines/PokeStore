<?php

$host = "192.168.10.49";
$port = "5432";
$database = "pokemon_store";
$usuario = "postgres";
$senha = "011625";

try {

    $conexao = new PDO(
        "pgsql:host=$host;port=$port;dbname=$database",
        $usuario,
        $senha
    );

} catch (PDOException $e) {

    echo "Erro ao conectar com o banco de dados.";

}

?>