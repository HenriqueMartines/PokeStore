<?php require_once '../includes/functions.php';?>
<?php require_once '../login/verifica_user.php';?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Produtos</title>
</head>
<body>
    <?php include '../includes/header.php';?>
    <main>
        <h1>Relatório de Produtos</h1>
        <?php relatorio($conexao); ?>
    </main>
    <?php include '../includes/footer.php';?>
</body>
</html>