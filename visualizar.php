<?php
require_once 'conexao.php';
$pagina_ativa = 'listagem';
require_once 'header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$servidor = false;

if ($id > 0) {
    $sql = "SELECT * FROM servidores WHERE id = {$id} LIMIT 1";
    $resultado = pg_query($conexao, $sql);
    if ($resultado && pg_num_rows($resultado) == 1) {
        $servidor = pg_fetch_assoc($resultado);
    }
}
?>

<div class="cabecalho-pagina">
    <h2>Detalhes do Funcionário</h2>
</div>

<div class="conteudo-box">
    <div class="box-formulario detalhes-box">
        <?php if ($servidor) { ?>
            <div class="box-titulo">
                <span class="icone-box">👤</span>
                <h3><?php echo htmlspecialchars($servidor['nome']); ?></h3>
            </div>

            <div class="detalhes-grid">
                <div><strong>ID:</strong> <?php echo htmlspecialchars($servidor['id']); ?></div>
                <div><strong>Departamento:</strong> <?php echo htmlspecialchars($servidor['departamento']); ?></div>
                <div><strong>E-mail:</strong> <?php echo htmlspecialchars($servidor['email']); ?></div>
                <div><strong>Telefone:</strong> <?php echo htmlspecialchars($servidor['telefone']); ?></div>
                <div><strong>Status:</strong> <?php echo htmlspecialchars($servidor['status']); ?></div>
                <div><strong>Data de registro:</strong> <?php echo htmlspecialchars($servidor['data_registro']); ?></div>
            </div>

            <div class="acoes-formulario">
                <a href="cadastro.php?id=<?php echo $servidor['id']; ?>" class="botao botao-primario">Editar</a>
                <a href="listagem.php" class="botao botao-link">Voltar</a>
            </div>
        <?php } else { ?>
            <div class="mensagem erro">Funcionário não encontrado.</div>
            <div class="acoes-formulario">
                <a href="listagem.php" class="botao botao-link">Voltar</a>
            </div>
        <?php } ?>
    </div>
</div>

<?php require_once 'footer.php'; ?>
