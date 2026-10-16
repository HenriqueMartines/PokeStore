<?php
session_start();

include '../config/conexao.php';
include '../includes/functions.php';

// Proteção: apenas admin acessa
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'admin') {
    header("Location: ../login/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $preco = $_POST['preco'];
    $descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';
    $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : 0;
    $nome_imagem = '';

    // Trata o upload da imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nome_imagem = time() . '_' . uniqid() . '.' . $extensao;

        $pasta_destino = '../imagens/';

        // Cria a pasta se não existir
        if (!is_dir($pasta_destino)) {
            mkdir($pasta_destino, 0777, true);
        }

        move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta_destino . $nome_imagem);
    }

    // Insere no banco de dados
    if (!empty($nome) && !empty($preco)) {
        adicionar_produto($conexao, $nome, $preco, $nome_imagem, $descricao, $quantidade);
        header("Location: index.php");
        exit;
    } else {
        $erro = "Preencha o nome e o preço do produto!";
    }
}
?>

<?php include '../includes/header.php'; ?>

<h2>Adicionar Novo Produto</h2>

<?php if (isset($erro)): ?>
    <p style="color: red;"><?php echo $erro; ?></p>
<?php endif; ?>

<form method="POST" action="adicionar.php" enctype="multipart/form-data">
    <label>Nome da Carta/Produto:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Preço:</label><br>
    <input type="number" step="0.01" name="preco" required><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao"></textarea><br><br>

    <label>Quantidade:</label><br>
    <input type="number" name="quantidade" value="1"><br><br>

    <label>Imagem do Produto:</label><br>
    <input type="file" name="imagem" accept="image/*"><br><br>

    <button type="submit">Guardar Produto</button>
</form>

<br>
<a href="index.php">Voltar ao Painel Admin</a>

<?php include '../includes/footer.php'; ?>