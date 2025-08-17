<?php
    include_once "../dao/vendaDao.inc.php";


    $opcao = (int)$_REQUEST['opcao'];

    if($opcao == 1){ //Incluir venda
        session_start();
        $carrinho = $_SESSION['carrinho'];
        $cliente = $_SESSION['cliente'];
        $total = $_SESSION['total'];


        $venda = new Venda($cliente->cpf, $total);
        $vendaDao = new VendaDao();
        $vendaDao->incluirVenda($venda, $carrinho);

        header("Location: ../views/boleto/meuBoleto.php");


    }

?>