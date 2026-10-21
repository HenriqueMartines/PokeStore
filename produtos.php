<?php
include 'config/conexao.php';
include 'includes/functions.php';

// Função para tratar o caminho da imagem de forma automática
function formatar_caminho_imagem($caminho) {
    if (empty($caminho)) {
        return '';
    }
    
    // Se for URL externa, devolve diretamente
    if (strpos($caminho, 'http') === 0) {
        return $caminho;
    }

    // Limpa barras e prefixos de pasta pai (../)
    $limpo = ltrim($caminho, '/');
    $limpo = str_replace('../', '', $limpo);

    // Remove 'pokestore/' do início se já existir
    if (strpos($limpo, 'pokestore/') === 0) {
        $limpo = substr($limpo, strlen('pokestore/'));
    }

    // Se não contiver a pasta 'imagens/' ou 'uploads/', adiciona 'imagens/'
    if (strpos($limpo, 'imagens/') !== 0 && strpos($limpo, 'uploads/') !== 0) {
        $limpo = 'imagens/' . $limpo;
    }

    return '/pokestore/' . $limpo;
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$produto = null;
$produtos = [];

if ($id && $id > 0) {
    $produto = consultar_produto($conexao, $id);
} else {
    $produtos = listar_produtos($conexao);
}
?>

<?php include 'includes/header.php'; ?>

<?php if ($id && $id > 0): ?>

    <?php if ($produto): ?>
        <h2><?php echo html_escape($produto['nome']); ?></h2>

        <?php if (!empty($produto['imagem'])): ?>
            <img src="<?php echo html_escape(formatar_caminho_imagem($produto['imagem'])); ?>" 
                 alt="<?php echo html_escape($produto['nome']); ?>" 
                 style="max-width: 300px;">
        <?php endif; ?>

        <p><?php echo html_escape($produto['descricao']); ?></p>

        <p>
            Preço: <strong>R$ <?php echo html_escape($produto['preco']); ?></strong>
        </p>

        <p>
            Quantidade disponível: <?php echo (int) $produto['quantidade']; ?>
        </p>

        <button onclick="alert('Produto adicionado à compra!')">Comprar</button>
    <?php else: ?>
        <p>Produto não encontrado.</p>
    <?php endif; ?>

<?php else: ?>

    <h2>Catálogo de Produtos</h2>

    <div class="produtos">
        <?php if (!empty($produtos)): ?>
            <?php foreach ($produtos as $p): ?>
                <div class="produto-card">
                    <?php if (!empty($p['imagem'])): ?>
                        <img src="<?php echo html_escape(formatar_caminho_imagem($p['imagem'])); ?>" 
                             alt="<?php echo html_escape($p['nome']); ?>">
                    <?php endif; ?>
                    <h3><?php echo html_escape($p['nome']); ?></h3>
                    <p>R$ <?php echo html_escape($p['preco']); ?></p>
                    <a href="produtos.php?id=<?php echo $p['id']; ?>">Ver detalhes</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum produto cadastrado no momento.</p>
        <?php endif; ?>
    </div>

<?php endif; ?>

<?php include 'includes/footer.php'; ?>