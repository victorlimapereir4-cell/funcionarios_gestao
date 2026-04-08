<?php
require_once 'conexao.php';
$pagina_ativa = 'cadastro';
require_once 'header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$servidor = array(
    'id' => '',
    'nome' => '',
    'departamento' => '',
    'email' => '',
    'telefone' => '',
    'status' => 'Ativo'
);
$titulo = 'Novo Funcionário';

if ($id > 0) {
    $sql = "SELECT * FROM servidores WHERE id = {$id} LIMIT 1";
    $resultado = pg_query($conexao, $sql);

    if ($resultado && pg_num_rows($resultado) == 1) {
        $servidor = pg_fetch_assoc($resultado);
        $titulo = 'Editar Funcionário';
    }
}

$mensagem = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<div class="cabecalho-pagina">
    <h2><?php echo $titulo; ?></h2>
    <p>Preencha os dados principais do funcionário.</p>
</div>

<div class="conteudo-box">
    <div class="box-formulario">
        <div class="box-titulo">
            <span class="icone-box">📁</span>
            <h3>Cadastro de Funcionário</h3>
        </div>

        <?php if ($mensagem != '') { ?>
            <div class="mensagem sucesso"><?php echo htmlspecialchars($mensagem); ?></div>
        <?php } ?>

        <form action="salvar.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($servidor['id']); ?>">

            <div class="grid-formulario">
                <div class="grupo-campo">
                    <label>ID</label>
                    <input type="text" value="<?php echo ($servidor['id'] != '') ? htmlspecialchars($servidor['id']) : 'Automático'; ?>" disabled>
                </div>

                <div class="grupo-campo">
                    <label>Departamento</label>
                    <select name="departamento" required>
                        <option value="">Selecione</option>
                        <option value="Protocolo" <?php echo ($servidor['departamento'] == 'Protocolo') ? 'selected' : ''; ?>>Protocolo</option>
                        <option value="Gabinete" <?php echo ($servidor['departamento'] == 'Gabinete') ? 'selected' : ''; ?>>Gabinete</option>
                        <option value="Financeiro" <?php echo ($servidor['departamento'] == 'Financeiro') ? 'selected' : ''; ?>>Financeiro</option>
                        <option value="Tecnologia" <?php echo ($servidor['departamento'] == 'Tecnologia') ? 'selected' : ''; ?>>Tecnologia</option>
                        <option value="Atendimento" <?php echo ($servidor['departamento'] == 'Atendimento') ? 'selected' : ''; ?>>Atendimento</option>
                    </select>
                </div>

                <div class="grupo-campo largura-total">
                    <label>Nome completo</label>
                    <input type="text" name="nome" value="<?php echo htmlspecialchars($servidor['nome']); ?>" placeholder="Digite o nome completo" required>
                </div>

                <div class="grupo-campo">
                    <label>E-mail</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($servidor['email']); ?>" placeholder="nome@orgao.gov.br" required>
                </div>

                <div class="grupo-campo">
                    <label>Telefone</label>
                    <input type="text" name="telefone" value="<?php echo htmlspecialchars($servidor['telefone']); ?>" placeholder="(61) 99999-9999" required>
                </div>

                <div class="grupo-campo largura-total">
                    <label>Status</label>
                    <div class="radio-area">
                        <label class="radio-item"><input type="radio" name="status" value="Ativo" <?php echo ($servidor['status'] == 'Ativo') ? 'checked' : ''; ?>> Ativo</label>
                        <label class="radio-item"><input type="radio" name="status" value="Licença" <?php echo ($servidor['status'] == 'Licença') ? 'checked' : ''; ?>> Licença</label>
                        <label class="radio-item"><input type="radio" name="status" value="Desligado" <?php echo ($servidor['status'] == 'Desligado') ? 'checked' : ''; ?>> Desligado</label>
                    </div>
                </div>
            </div>

            <div class="acoes-formulario">
                <button type="submit" class="botao botao-primario">Salvar</button>
                <button type="reset" class="botao">Limpar</button>
                <a href="listagem.php" class="botao botao-link">Voltar</a>
            </div>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
