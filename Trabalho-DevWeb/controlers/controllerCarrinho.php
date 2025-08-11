<?php
    require_once '../classes/produto.inc.php';
    require_once '../classes/item.inc.php';
    require_once '../dao/ProdutoDao.inc.php';


    $opcao= $_REQUEST['opcao'];

    if($opcao == 1){ //Incluir no Carrinho
        $id = (int)$_REQUEST['id'];

        $produtoDao = new ProdutoDao();
        $produto = $produtoDao->getProduto($id);
        $item = new Item($produto);
        session_start();

        if(isset($_SESSION['carrinho'])){
            $carrinho = $_SESSION['carrinho'];    
        }
        else{
            $carrinho = array();
        }
        if(in_array($item, $carrinho)){
            $key = array_search($item, $carrinho);

            $carrinho[$key]->setQuantidade();
            $carrinho[$key]->setValorItem();
        }
        else{
            $carrinho[] = $item;
        }
        $_SESSION['carrinho'] = $carrinho;

        header("Location: ../views/exibirCarrinho.php");
    }



?>