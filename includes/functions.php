<?php
function adicionar_produto($conexao, $nome, $preco, $imagem, $descricao, $quantidade)
{
    $sql = "INSERT INTO produtos (nome, preco, imagem, descricao, quantidade) VALUES (:nome, :preco, :imagem, :descricao, :quantidade)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':preco', $preco);
    $stmt->bindValue(':imagem', $imagem);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);

    return $stmt->execute();
}

function apagar_produto($conexao, $id)
{
    $stmt = $conexao->prepare("DELETE FROM produtos WHERE id = :id");
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    return $stmt->execute();
}

function listar_produtos($conexao)
{
    $stmt = $conexao->prepare("SELECT * FROM produtos");
    $stmt->execute();
    return $stmt->fetchAll();
}

function consultar_produto($conexao, $id)
{
    $stmt = $conexao->prepare("SELECT * FROM produtos WHERE id = :id");
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function atualizar_produto($conexao, $id, $nome, $descricao, $preco, $quantidade)
{
    $sql = "UPDATE produtos SET
            nome = :nome,
            descricao = :descricao,
            preco = :preco,
            quantidade = :quantidade
            WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":descricao", $descricao);
    $stmt->bindValue(":preco", $preco);
    $stmt->bindValue(":quantidade", $quantidade, PDO::PARAM_INT);

    return $stmt->execute();
}

function cadastrar_user($conexao, $usuario, $senha, $tipo)
{
    $sql = "INSERT INTO usuarios (usuario, senha, tipo)
            VALUES (:usuario, :senha, :tipo)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(":usuario", $usuario);
    $stmt->bindValue(":senha", password_hash($senha, PASSWORD_DEFAULT));
    $stmt->bindValue(":tipo", $tipo);

    return $stmt->execute();
}

function consulta_user($conexao, $usuario)
{
    $sql = "SELECT * FROM usuarios WHERE LOWER(usuario) = LOWER(:usuario)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(":usuario", trim($usuario));
    $stmt->execute();

    return $stmt->fetch();
}

function validar_senha_user($conexao, $dados, $senha)
{
    $hashArmazenado = (string) $dados['senha'];
    $infoHash = password_get_info($hashArmazenado);

    if ($infoHash['algo'] !== null) {
        if (!password_verify($senha, $hashArmazenado)) {
            return false;
        }
    } elseif (!hash_equals($hashArmazenado, $senha)) {
        return false;
    }

    if (
        $infoHash['algo'] === null ||
        password_needs_rehash($hashArmazenado, PASSWORD_DEFAULT)
    ) {
        $stmt = $conexao->prepare(
            "UPDATE usuarios SET senha = :senha WHERE usuario = :usuario"
        );
        $stmt->bindValue(":senha", password_hash($senha, PASSWORD_DEFAULT));
        $stmt->bindValue(":usuario", $dados['usuario']);
        $stmt->execute();
    }

    return true;
}

function html_escape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function validar_csrf_token($token)
{
    return isset($_SESSION['csrf_token']) &&
        is_string($token) &&
        hash_equals($_SESSION['csrf_token'], $token);
}
?>
