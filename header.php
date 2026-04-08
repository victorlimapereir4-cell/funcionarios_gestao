<?php
require_once 'auth.php';
exigir_login();
$pagina_ativa = isset($pagina_ativa) ? $pagina_ativa : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Portal RH Interno</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body class="pagina-interna">
    <div class="container-principal">
        <div class="topo-sistema">
            <div class="logo-area">
                <div class="logo-marca"></div>
                <div>
                    <div class="logo-titulo">Portal RH Interno</div>
                    <div class="logo-subtitulo">Cadastro e consulta de servidores</div>
                </div>
            </div>

            <div class="menu-topo">
                <a href="cadastro.php" class="<?php echo ($pagina_ativa == 'cadastro') ? 'ativo' : ''; ?>">Cadastro</a>
                <a href="listagem.php" class="<?php echo ($pagina_ativa == 'listagem') ? 'ativo' : ''; ?>">Consulta</a>
            </div>

            <div class="usuario-topo">
                <span><?php echo htmlspecialchars(nome_usuario_logado()); ?></span>
                <a href="logout.php" class="sair-link">Sair</a>
            </div>
        </div>
