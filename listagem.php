<?php
require_once 'conexao.php';
$pagina_ativa = 'listagem';
require_once 'header.php';

$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';
$filtro_status = isset($_GET['status']) ? trim($_GET['status']) : '';
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$pagina = ($pagina < 1) ? 1 : $pagina;
$itens_por_pagina = 6;
$offset = ($pagina - 1) * $itens_por_pagina;

$condicoes = array();
if ($busca != '') {
    $busca_sql = pg_escape_string($conexao, $busca);
    $condicoes[] = "(nome ILIKE '%{$busca_sql}%' OR departamento ILIKE '%{$busca_sql}%' OR email ILIKE '%{$busca_sql}%' OR telefone ILIKE '%{$busca_sql}%')";
}
if ($filtro_status != '') {
    $status_sql = pg_escape_string($conexao, $filtro_status);
    $condicoes[] = "status = '{$status_sql}'";
}

$filtro = '';
if (count($condicoes) > 0) {
    $filtro = ' WHERE ' . implode(' AND ', $condicoes);
}

$sql_total = "SELECT COUNT(*) AS total FROM servidores {$filtro}";
$resultado_total = pg_query($conexao, $sql_total);
$total_registros = 0;
if ($resultado_total) {
    $dados_total = pg_fetch_assoc($resultado_total);
    $total_registros = (int) $dados_total['total'];
}
$total_paginas = ($total_registros > 0) ? ceil($total_registros / $itens_por_pagina) : 1;

$sql = "SELECT * FROM servidores {$filtro} ORDER BY nome ASC LIMIT {$itens_por_pagina} OFFSET {$offset}";
$resultado = pg_query($conexao, $sql);
$mensagem = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<div class="cabecalho-pagina">
    <h2>Consulta de Funcionários</h2>
    <p>Pesquise por nome, departamento, e-mail ou telefone.</p>
</div>

<div class="conteudo-box">
    <div class="barra-listagem">
        <form action="listagem.php" method="get" class="form-busca">
            <input type="text" name="busca" value="<?php echo htmlspecialchars($busca); ?>" placeholder="Buscar funcionário">
            <select name="status">
                <option value="">Todos os status</option>
                <option value="Ativo" <?php echo ($filtro_status == 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                <option value="Licença" <?php echo ($filtro_status == 'Licença') ? 'selected' : ''; ?>>Licença</option>
                <option value="Desligado" <?php echo ($filtro_status == 'Desligado') ? 'selected' : ''; ?>>Desligado</option>
            </select>
            <button type="submit" class="botao botao-primario">Pesquisar</button>
            <a href="cadastro.php" class="botao botao-link">Novo</a>
        </form>
    </div>

    <?php if ($mensagem != '') { ?>
        <div class="mensagem sucesso"><?php echo htmlspecialchars($mensagem); ?></div>
    <?php } ?>

    <table class="tabela-listagem">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Departamento</th>
                <th>Telefone</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultado && pg_num_rows($resultado) > 0) { ?>
                <?php while ($linha = pg_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($linha['id']); ?></td>
                        <td><?php echo htmlspecialchars($linha['nome']); ?></td>
                        <td><?php echo htmlspecialchars($linha['departamento']); ?></td>
                        <td><?php echo htmlspecialchars($linha['telefone']); ?></td>
                        <td>
                            <span class="badge <?php echo strtolower(str_replace('ç','c', str_replace('ã','a',$linha['status']))); ?>">
                                <?php echo htmlspecialchars($linha['status']); ?>
                            </span>
                        </td>
                        <td class="acoes-tabela">
                            <a href="visualizar.php?id=<?php echo $linha['id']; ?>" title="Visualizar">🔍</a>
                            <a href="cadastro.php?id=<?php echo $linha['id']; ?>" title="Editar">✏️</a>
                            <a href="excluir.php?id=<?php echo $linha['id']; ?>" title="Excluir" onclick="return confirm('Confirma a exclusão deste funcionário?');">🗑️</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="6" class="sem-registros">Nenhum funcionário localizado.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="paginacao">
        <?php if ($pagina > 1) { ?>
            <a href="listagem.php?busca=<?php echo urlencode($busca); ?>&status=<?php echo urlencode($filtro_status); ?>&pagina=<?php echo ($pagina - 1); ?>">&laquo; Anterior</a>
        <?php } ?>

        <?php $i = 1; while ($i <= $total_paginas) { ?>
            <a href="listagem.php?busca=<?php echo urlencode($busca); ?>&status=<?php echo urlencode($filtro_status); ?>&pagina=<?php echo $i; ?>" class="<?php echo ($i == $pagina) ? 'ativo' : ''; ?>"><?php echo $i; ?></a>
        <?php $i++; } ?>

        <?php if ($pagina < $total_paginas) { ?>
            <a href="listagem.php?busca=<?php echo urlencode($busca); ?>&status=<?php echo urlencode($filtro_status); ?>&pagina=<?php echo ($pagina + 1); ?>">Próxima &raquo;</a>
        <?php } ?>
    </div>
</div>

<?php require_once 'footer.php'; ?>
