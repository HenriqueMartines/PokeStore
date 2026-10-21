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
    $nome = trim($_POST['nome'] ?? '');
    $preco = $_POST['preco'] ?? '';
    $descricao = trim($_POST['descricao'] ?? '');
    $quantidade = filter_var($_POST['quantidade'] ?? 0, FILTER_VALIDATE_INT);
    $nome_imagem = '';

    if (!validar_csrf_token($_POST['csrf_token'] ?? null)) {
        $erro = "A solicitação expirou. Atualize a página e tente novamente.";
    } elseif ($nome === '' || !is_numeric($preco) || (float) $preco < 0 || $quantidade === false || $quantidade < 0) {
        $erro = "Informe nome, preço válido e quantidade não negativa.";
    } else {
        $upload = $_FILES['imagem'] ?? null;

        if ($upload && $upload['error'] !== UPLOAD_ERR_NO_FILE) {
            if ($upload['error'] !== UPLOAD_ERR_OK || $upload['size'] > 5 * 1024 * 1024) {
                $erro = "Não foi possível enviar a imagem ou ela excede o limite de 5 MB.";
            } else {
                $tiposPermitidos = [
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/webp' => 'webp',
                    'image/avif' => 'avif',
                ];
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $tipo = $finfo->file($upload['tmp_name']);

                if (!isset($tiposPermitidos[$tipo])) {
                    $erro = "Formato de imagem inválido. Use JPEG, PNG, WebP ou AVIF.";
                } else {
                    $pastaDestino = '../imagens/';

                    // ✅ CÓDIGO NOVO (Não quebra a página):
                    if (!is_dir($pastaDestino)) {
                        @mkdir($pastaDestino, 0775, true);
                    }

                    if (!is_dir($pastaDestino) || !is_writable($pastaDestino)) {
                         $erro = "Sem permissão para salvar imagens na pasta 'imagens/'. Execute o chown/chmod no servidor.";
                    } else {
                         $nome_imagem = bin2hex(random_bytes(16)) . '.' . $tiposPermitidos[$tipo];
                    if (!move_uploaded_file($upload['tmp_name'], $pastaDestino . $nome_imagem)) {
                     $erro = "Falha ao mover a imagem para o servidor.";
                    }
                }   
                }
            }
        }

        if (!isset($erro)) {
            adicionar_produto($conexao, $nome, $preco, $nome_imagem, $descricao, $quantidade);
            header("Location: index.php");
            exit;
        }
    }
}
?>

<?php include '../includes/header.php'; ?>

<h2>Adicionar Novo Produto</h2>

<?php if (isset($erro)): ?>
    <p style="color: red;"><?php echo html_escape($erro); ?></p>
<?php endif; ?>

<form method="POST" action="adicionar.php" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo html_escape(csrf_token()); ?>">
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