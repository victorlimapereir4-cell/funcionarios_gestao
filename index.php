<?php
require_once 'auth.php';
if (usuario_logado()) {
    header('Location: listagem.php');
    exit;
}
$erro = isset($_GET['erro']) ? $_GET['erro'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Portal RH Interno</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body class="pagina-login">
    <div class="painel-login">
        <div class="painel-lateral">
            <div class="selo-login"></div>
            <h1>Portal RH Interno</h1>
            <p>Ambiente acadêmico para controle de servidores, lotações e status funcionais.</p>
        </div>
        <div class="painel-formulario">
            <h2>Acesso ao Sistema</h2>
            <p class="texto-apoio">Informe seu usuário e senha para continuar.</p>

            <?php if ($erro != '') { ?>
                <div class="mensagem erro"><?php echo htmlspecialchars($erro); ?></div>
            <?php } ?>

            <form action="login.php" method="post">
                <div class="grupo-login">
                    <label>Usuário</label>
                    <input type="text" name="usuario" placeholder="Digite seu usuário" required>
                </div>

                <div class="grupo-login">
                    <label>Senha</label>
                    <input type="password" name="senha" placeholder="Digite sua senha" required>
                </div>

                <button type="submit" class="botao botao-primario botao-login">Entrar</button>
            </form>

            <div class="rodape-login">PHP5 + PostgreSQL</div>
        </div>
    </div>
</body>
</html>
