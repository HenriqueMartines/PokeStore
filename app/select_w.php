<?php require_once '../includes/functions.php';?>
<?php require_once '../login/verifica_user.php';?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Produto</title>
</head>
<body>
    <?php include '../includes/header.php';?>
    <h1>Consultar Produto</h1>
    <form action="" method="post">
        <label for="id">ID: </label>
        <input type="number" name="id" id="id" required> <br><br>
        <input type="submit" value="Consultar">
    </form>
    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        consultar($conexao, $_POST['id']);
    }
    ?>
    <?php include '../includes/footer.php';?>
</body>
</html>