<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> img src=Poké Store </title>
        
    
</a>
    <link rel="stylesheet" href="/pokestore/css/style.css">
</head>

<body>

<header>
    <h1>Poké Store</h1>
    <nav>
        <a href="/pokestore/index.php">Início</a>
        <a href="/pokestore/produtos.php">Produtos</a>

        <?php if (isset($_SESSION['usuario'])): ?>
            <?php if ($_SESSION['tipo'] == 'admin'): ?>
                <a href="/pokestore/admin/index.php">Painel Admin</a>
            <?php endif; ?>
            <a href="/pokestore/login/logout.php">Sair (<?php echo $_SESSION['usuario']; ?>)</a>
        <?php else: ?>
            <a href="/pokestore/login/login.php">Login</a>
            <a href="/pokestore/login/cadastrar.php">Cadastrar-se</a>
        <?php endif; ?>
    </nav>
</header>



<main>