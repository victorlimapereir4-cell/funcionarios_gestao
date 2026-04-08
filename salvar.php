<?php
require_once 'conexao.php';
require_once 'auth.php';
exigir_login();

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$departamento = isset($_POST['departamento']) ? trim($_POST['departamento']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
$status = isset($_POST['status']) ? trim($_POST['status']) : 'Ativo';

if ($nome == '' || $departamento == '' || $email == '' || $telefone == '') {
    $destino = ($id > 0) ? 'cadastro.php?id=' . $id : 'cadastro.php';
    header('Location: ' . $destino . '&msg=' . urlencode('Preencha todos os campos obrigatórios.'));
    exit;
}

$nome = pg_escape_string($conexao, $nome);
$departamento = pg_escape_string($conexao, $departamento);
$email = pg_escape_string($conexao, $email);
$telefone = pg_escape_string($conexao, $telefone);
$status = pg_escape_string($conexao, $status);

if ($id > 0) {
    $sql = "UPDATE servidores SET nome = '{$nome}', departamento = '{$departamento}', email = '{$email}', telefone = '{$telefone}', status = '{$status}' WHERE id = {$id}";
    pg_query($conexao, $sql);
    header('Location: cadastro.php?id=' . $id . '&msg=' . urlencode('Funcionário atualizado com sucesso.'));
    exit;
}

$sql = "INSERT INTO servidores (nome, departamento, email, telefone, status) VALUES ('{$nome}', '{$departamento}', '{$email}', '{$telefone}', '{$status}')";
pg_query($conexao, $sql);
header('Location: cadastro.php?msg=' . urlencode('Funcionário cadastrado com sucesso.'));
exit;
?>
