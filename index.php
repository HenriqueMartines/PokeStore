<?php
include 'config/conexao.php';
include 'includes/functions.php';
include 'includes/header.php';
?>

<div class="banner-promocional">        
    <img src="imagens/banner.jpg" alt="Novo Banner promocional da Poké Store">
</div>

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

            <img src="imagens/<?php echo rawurlencode($produto['imagem']); ?>" alt="<?php echo html_escape($produto['nome']); ?>">

        <?php } ?>

        <h3>
            <?php echo html_escape($produto['nome']); ?>
        </h3>

        <p>
            <?php echo html_escape($produto['descricao']); ?>
        </p>

        <p>
            R$ <?php echo html_escape($produto['preco']); ?>
        </p>

        <p>
            Estoque: <?php echo (int) $produto['quantidade']; ?>
        </p>

        <a class="botao"
           href="produtos.php?id=<?php echo (int) $produto['id']; ?>">

            Ver produto

        </a>

    </div>

<?php

}

?>

</div>

<?php include 'includes/footer.php'; ?>