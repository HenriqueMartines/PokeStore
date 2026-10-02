<?php 
require_once '../database/conect.php';

function cadastrar($conexao, $nome, $descricao, $categoria, $preco, $estoque, $imagem){   
    $sql = "INSERT INTO produtos (nome, descricao, categoria, preco, estoque, imagem) 
            VALUES (:nome, :descricao, :categoria, :preco, :estoque, :imagem)";

    try {
        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":descricao", $descricao);
        $stmt->bindValue(":categoria", $categoria);
        $stmt->bindValue(":preco", $preco);
        $stmt->bindValue(":estoque", $estoque);
        $stmt->bindValue(":imagem", $imagem);

        $stmt->execute();
        echo "Produto inserido com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function apagar($conexao, $id){
    $sql = "DELETE FROM produtos WHERE id = :id";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        echo "Produto $id removido com sucesso!";
    } catch (PDOException $e){
        echo "erro: " . $e->getMessage();
    }
}

function relatorio($conexao){
    $sql = "SELECT * FROM produtos";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($produtos as $produto) {
            echo "ID: {$produto['id']}<br>";
            echo "Nome: {$produto['nome']}<br>";
            echo "Descrição: {$produto['descricao']}<br>";
            echo "Categoria: {$produto['categoria']}<br>";
            echo "Preço: R$ {$produto['preco']}<br>";
            echo "Estoque: {$produto['estoque']}<br>";
            if (!empty($produto['imagem'])) {
                echo "<img src='/{$produto['imagem']}' width='100'><br>";
            }
            echo "<hr>";
        }
    } catch (PDOException $e) {
        echo "erro: " . $e->getMessage();
    }
}

function atualizar($conexao, $id, $nome, $descricao, $categoria, $preco, $estoque, $imagem){
    $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, categoria = :categoria, preco = :preco, estoque = :estoque, imagem = :imagem WHERE id = :id";
    try {
        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":descricao", $descricao);
        $stmt->bindValue(":categoria", $categoria);
        $stmt->bindValue(":preco", $preco);
        $stmt->bindValue(":estoque", $estoque);
        $stmt->bindValue(":imagem", $imagem);

        $stmt->execute();
        echo "Produto atualizado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function consultar($conexao, $id){
    $sql = "SELECT * FROM produtos WHERE id = :id";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $produto = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($produto) {
            echo "Nome: {$produto['nome']} <br>";
            echo "Descrição: {$produto['descricao']} <br>";
            echo "Categoria: {$produto['categoria']} <br>";
            echo "Preço: R$ {$produto['preco']} <br>";
            echo "Estoque: {$produto['estoque']} <br>";
            if (!empty($produto['imagem'])) {
                echo "<img src='/{$produto['imagem']}' width='100'><br>";
            }
        } else {
            echo "Produto não encontrado!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Funções de Usuário / Login
    function cadastrar_user($conexao, $nome, $email, $senha){   
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);

        $stmt->execute();
        echo "Usuário inserido com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function consulta_user($conexao, $email){
    $sql = "SELECT id, email, senha FROM usuarios WHERE email = :email";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario; 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}


?>
