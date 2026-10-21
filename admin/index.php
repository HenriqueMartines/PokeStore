<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login/login.php");
    exit;
}

if ($_SESSION['tipo'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

include '../config/conexao.php';
include '../includes/functions.php'; // Incluído para usar listar_produtos()
?>

<?php include '../includes/header.php'; ?>

<h2>Área do Administrador</h2>

<p>
    Bem-vindo, <?php echo html_escape($_SESSION['usuario']); ?>!
</p>

<p>
    <a class="botao" href="adicionar.php">
        Adicionar produto
    </a>
</p>

<h2>Produtos</h2>

<?php
$produtos = listar_produtos($conexao);

if (!empty($produtos)) {
    foreach ($produtos as $produto) {
?>
        <div class="produto">
            <?php if (!empty($produto['imagem'])) { ?>
                <img src="../imagens/<?php echo rawurlencode($produto['imagem']); ?>" alt="<?php echo html_escape($produto['nome']); ?>">
            <?php } ?>

            <h3><?php echo html_escape($produto['nome']); ?></h3>

            <p>R$ <?php echo html_escape($produto['preco']); ?></p>

            <a class="botao" href="editar.php?id=<?php echo (int) $produto['id']; ?>">
                Editar
            </a>

            <form method="POST" action="excluir.php">
                <input type="hidden" name="id" value="<?php echo (int) $produto['id']; ?>">
                <input type="hidden" name="csrf_token" value="<?php echo html_escape(csrf_token()); ?>">
                <button class="botao" type="submit">Excluir</button>
            </form>
        </div>
<?php
    }
}

?>

<?php include '../includes/footer.php'; ?>