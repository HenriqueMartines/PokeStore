<?php require_once '../includes/functions.php';?>
<?php require_once '../login/verifica_user.php';?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Produto</title>
</head>
<body>
    <?php include '../includes/header.php';?>
    <main>
    <h1>Atualizar Produto</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="id">ID: </label>
        <input type="number" name="id" id="id" placeholder="Insira Id para atualizar" required><br>
        
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome"><br>
        
        <label for="descricao">Descrição: </label>
        <textarea name="descricao" id="descricao"></textarea><br>
        
        <label for="categoria">Categoria: </label>
        <select name="categoria" id="categoria">
            <option value="cartas">Cartas</option>
            <option value="box">Box</option>
            <option value="acessorios">Acessórios</option>
        </select><br>
        
        <label for="preco">Preço: </label>
        <input type="number" step="0.01" name="preco" id="preco"><br>
        
        <label for="estoque">Estoque: </label>
        <input type="number" name="estoque" id="estoque"><br>
        
        <label for="imagem">Imagem: </label>
        <input type="file" name="imagem" id="imagem"><br><br>

        <input type="submit" value="Atualizar">
        <input type="reset" value="Limpar">
    </form>

    <?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $caminho_imagem = "";
        
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
            $categoria = $_POST['categoria'];
            $pasta = "../assets/images/produtos/" . $categoria . "/";
            
            if (!is_dir($pasta)) {
                mkdir($pasta, 0777, true);
            }
            
            $nome_arquivo = time() . "_" . $_FILES['imagem']['name'];
            $destino = $pasta . $nome_arquivo;
            
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
                $caminho_imagem = "assets/images/produtos/" . $categoria . "/" . $nome_arquivo;
            }
        }

        atualizar($conexao, $_POST['id'], $_POST['nome'], $_POST['descricao'], $_POST['categoria'], $_POST['preco'], $_POST['estoque'], $caminho_imagem);
    }
    ?>

    </main>
    <?php include '../includes/footer.php';?>
</body>
</html>