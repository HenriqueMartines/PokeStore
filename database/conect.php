<?php
$host = "192.168.10.49";
$dbname = "pokemon_store";
$user = "postgres";
$pass = "011625"; // Altere para a sua senha do PostgreSQL

try {
    $conexao = new PDO(
        "pgsql:host=$host;dbname=$dbname",
        $user,
        $pass
    );
} catch (PDOException $e) {
    echo "erro: " . $e->getMessage();
}
?>