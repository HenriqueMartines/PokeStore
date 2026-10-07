<?php

function cadastrar_produto($conexao, $nome, $descricao, $preco, $quantidade, $imagem)
{

    $sql = "INSERT INTO produtos
            (nome, descricao, preco, quantidade, imagem)
            VALUES
            (:nome, :descricao, :preco, :quantidade, :imagem)";

    try {

        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":descricao", $descricao);
        $stmt->bindValue(":preco", $preco);
        $stmt->bindValue(":quantidade", $quantidade);
        $stmt->bindValue(":imagem", $imagem);

        $stmt->execute();

        echo "Produto cadastrado com sucesso!";

    } catch (PDOException $e) {

        echo "Erro: " . $e->getMessage();

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

    $sql = "SELECT * FROM usuarios
            WHERE usuario = :usuario";

    try {

        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(":usuario", $usuario);

        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return $usuario;

    } catch (PDOException $e) {

        echo "Erro: " . $e->getMessage();

    }

}

?>