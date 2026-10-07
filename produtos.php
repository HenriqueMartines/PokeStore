<?php include 'includes/header.php'; ?>

<?php

include 'config/conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM produtos WHERE id = $id";

$resultado = pg_query($conn, $sql);

$produto = pg_fetch_assoc($resultado);

?>

<?php if ($produto) { ?>

    <h2><?php echo $produto['nome']; ?></h2>

    <p>
        <?php echo $produto['descricao']; ?>
    </p>

    <p>
        Preço:
        <strong>
            R$ <?php echo $produto['preco']; ?>
        </strong>
    </p>

    <p>
        Quantidade disponível:
        <?php echo $produto['quantidade']; ?>
    </p>

    <button onclick="alert('Produto adicionado à compra!')">
        Comprar
    </button>

<?php } else { ?>

    <p>Produto não encontrado.</p>

<?php } ?>

<?php include 'includes/footer.php'; ?>