<?php
session_start();
include('conexao.php');
//include('log.php');

if (empty($_POST['usuario']) || empty($_POST['senha'])) {
    header('Location: index.php');
    exit();
}

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$query = "SELECT * FROM tb_usuario WHERE cpf = '{$usuario}' AND senha = MD5('{$senha}') and admin = 1";

$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);


if ($row == 1) {    
    $arrayUsuario = mysqli_fetch_array($result);
    $_SESSION['usuario'] = $usuario;
    $_SESSION['id_usuario'] = $arrayUsuario['id'];
    $_SESSION['nome'] = $arrayUsuario['nome'];
    //registra_log($usuario, "LoginSistema", "Login aceito", date('Y/m/d H:i:s'));
    header('Location: relatorio.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    //registra_log($usuario, "LoginSistema", "Login incorreto", date('Y/m/d H:i:s'));
    header('Location: index.php');
    exit();
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

