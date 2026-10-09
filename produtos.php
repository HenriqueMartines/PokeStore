<?php include 'includes/header.php'; ?>

<?php

include 'includes/functions.php';

$produto=null;

if (isset($_GET['id'])) {
    $produto = consultar_produto($conexao, $_GET['id']);
}

?>

<?php if ($produto): ?>

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

<?php  else:  ?>

    <p>Produto não encontrado.</p>

<?php endif; ?>
 