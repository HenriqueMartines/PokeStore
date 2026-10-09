<?php

include 'includes/header.php';

include 'config/conexao.php';

include 'includes/functions.php';

?>

<h2>Bem vindo a Poke Store!</h2>

<p>
    Encontre suas cartas Pokémon favoritas!!!
</p>

<h2>Produtos</h2>

<div class="produtos">

<?php

$produtos = listar_produtos($conexao);

foreach ($produtos as $produto) {

?>

    <div class="produto">

        <?php if ($produto['imagem'] != '') { ?>

            <img src="imagens/<?php echo $produto['imagem']; ?>">

        <?php } ?>

        <h3>
            <?php echo $produto['nome']; ?>
        </h3>

        <p>
            <?php echo $produto['descricao']; ?>
        </p>

        <p>
            R$ <?php echo $produto['preco']; ?>
        </p>

        <p>
            Estoque: <?php echo $produto['quantidade']; ?>
        </p>

        <a class="botao"
           href="produtos.php?id=<?php echo $produto['id']; ?>">

            Ver produto

        </a>

    </div>

<?php

}

?>

</div>

<?php include 'includes/footer.php'; ?>