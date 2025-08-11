<?php
require_once '../dao/clienteDAO.inc.php';
$op = $_REQUEST['pOpcao'];

if($op==1){//Autenticar
    $email = $_REQUEST['pEmail'];
    $senha = $_REQUEST['pSenha'];

    $clienteDao = new ClienteDao();
    $cliente = $clienteDao->autenticar($email, $senha);

    //Encontrado no banco de dados
    if($cliente != NULL){
        session_start();
        $_SESSION['cliente'] = $cliente;
        header("Location: ../views/exibirProdutos.php");
    }
    //Não encontrado no banco de dados
    else{
        header("Location: ..controlerProduto.php?opcao=2");
    }
} 

if($op==2){
    session_start();
    unset($_SESSION['cliente']);
    header("Location:../views/");
}

?>