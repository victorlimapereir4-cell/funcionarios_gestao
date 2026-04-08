<?php
require_once 'conexao.php';
require_once 'auth.php';
exigir_login();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id > 0) {
    $sql = "DELETE FROM servidores WHERE id = {$id}";
    pg_query($conexao, $sql);
}

header('Location: listagem.php?msg=' . urlencode('Servidor excluído com sucesso.'));
exit;
?>
