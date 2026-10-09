<?php
function adicionar_produto($conexao, $nome, $preco, $imagem)
{
    $sql = "INSERT INTO produtos (nome, preco, imagem) VALUES (:nome, :preco, :imagem)";
    
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':preco', $preco);
        $stmt->bindValue(':imagem', $imagem);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "<h3 style='color:red;'>Erro ao inserir produto na base de dados: " . $e->getMessage() . "</h3>";
        exit;
    }
}

function apagar_produto($conexao, $id)
{

    $sql = "DELETE FROM produtos WHERE id = :id";

    try {

        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(":id", $id);

        $stmt->execute();

        echo "Produto removido com sucesso!";

    } catch (PDOException $e) {

        echo "Erro: " . $e->getMessage();

    }

}


function listar_produtos($conexao)
{
    
    $sql = "SELECT * FROM produtos";

    try {

        $stmt = $conexao->prepare($sql);

        $stmt->execute();

        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $produtos;

    } catch (PDOException $e) {

        echo "Erro: " . $e->getMessage();

    }

}


function consultar_produto($conexao, $id)
{

    $sql = "SELECT * FROM produtos WHERE id = :id";

    try {

        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(":id", $id);

        $stmt->execute();

        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        return $produto;

    } catch (PDOException $e) {

        echo "Erro: " . $e->getMessage();

    }

}


function atualizar_produto($conexao, $id, $nome, $descricao, $preco, $quantidade)
{

    $sql = "UPDATE produtos SET
            nome = :nome,
            descricao = :descricao,
            preco = :preco,
            quantidade = :quantidade
            WHERE id = :id";

    try {

        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":descricao", $descricao);
        $stmt->bindValue(":preco", $preco);
        $stmt->bindValue(":quantidade", $quantidade);

        $stmt->execute();

        echo "Produto atualizado com sucesso!";

    } catch (PDOException $e) {

        echo "Erro: " . $e->getMessage();

    }

}


/* FUNÇÕES DO LOGIN */


function cadastrar_user($conexao, $usuario, $senha, $tipo)
{
    require_once '../config/conexao.php';
    $sql = "INSERT INTO usuarios
            (usuario, senha, tipo)
            VALUES
            (:usuario, :senha, :tipo)";

    try {

        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(":usuario", $usuario);
        $stmt->bindValue(":senha", $senha);
        $stmt->bindValue(":tipo", $tipo);

        $stmt->execute();

        echo "Usuário cadastrado com sucesso!";

    } catch (PDOException $e) {

        echo "Erro: " . $e->getMessage();

    }

}


function consulta_user($conexao, $usuario)
{
    // LOWER() garante que encontra o utilizador independentemente de maiúsculas/minúsculas
    $sql = "SELECT * FROM usuarios WHERE LOWER(usuario) = LOWER(:usuario)";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(":usuario", trim($usuario));
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Erro na consulta: " . $e->getMessage();
        return false;
    }
}

?>