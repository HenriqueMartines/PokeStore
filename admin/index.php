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
    Bem-vindo, <?php echo $_SESSION['usuario']; ?>!
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
                <img src="../imagens/<?php echo $produto['imagem']; ?>">
            <?php } ?>

            <h3><?php echo $produto['nome']; ?></h3>

            <p>R$ <?php echo $produto['preco']; ?></p>

            <a class="botao" href="editar.php?id=<?php echo $produto['id']; ?>">
                Editar
            </a>

            <a class="botao" href="excluir.php?id=<?php echo $produto['id']; ?>">
                Excluir
            </a>
        </div>
<?php
    }
}

?>

<?php include '../includes/footer.php'; ?>