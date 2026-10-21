<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define o caminho base do projeto como /pokestore
$basePath = '/pokestore';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poké Store</title>
    <link rel="stylesheet" href="<?php echo $basePath; ?>/css/style.css">
</head>

<body>

<header>
    <h1>Poké Store</h1>
    <nav>
        <a href="<?php echo htmlspecialchars($basePath, ENT_QUOTES, 'UTF-8'); ?>/index.php">Início</a>
        <a href="<?php echo htmlspecialchars($basePath, ENT_QUOTES, 'UTF-8'); ?>/produtos.php">Produtos</a>

        <?php if (isset($_SESSION['usuario'])): ?>
            <?php if ($_SESSION['tipo'] == 'admin'): ?>
                <a href="<?php echo htmlspecialchars($basePath, ENT_QUOTES, 'UTF-8'); ?>/admin/index.php">Painel Admin</a>
            <?php endif; ?>
            <a href="<?php echo htmlspecialchars($basePath, ENT_QUOTES, 'UTF-8'); ?>/login/logout.php">Sair (<?php echo htmlspecialchars($_SESSION['usuario'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>)</a>
        <?php else: ?>
            <a href="<?php echo htmlspecialchars($basePath, ENT_QUOTES, 'UTF-8'); ?>/login/login.php">Login</a>
            <a href="<?php echo htmlspecialchars($basePath, ENT_QUOTES, 'UTF-8'); ?>/login/cadastrar.php">Cadastrar-se</a>
        <?php endif; ?>
    </nav>
</header>

<main>