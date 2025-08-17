<?php
    require_once '../classes/produto.inc.php';
    require_once '../classes/item.inc.php';
    require_once '../dao/ProdutoDao.inc.php';

    //usar uma função array_search normal num funciona pois o item precisa ser completamente igual, essa função checa apenas pelo id
    function arraySearch($chave, $vetor){
        $index =-1;
        for($i=0; $i<count($vetor); $i++){
            if($chave == $vetor[$i]->getProduto()->getId()){
                $index = $i;
                break;
            }
        }
        return $index;
    }


    $opcao= (int)$_REQUEST['opcao'];

    if($opcao == 1){ //Incluir no Carrinho
        $id = (int)$_REQUEST['id'];

        $produtoDao = new ProdutoDao();
        $produto = $produtoDao->getProduto($id);
        $item = new Item($produto);
        session_start();
        //verifica se o carrinho está vazio ou não
        if(isset($_SESSION['carrinho'])){
            $carrinho = $_SESSION['carrinho'];    
        }
        else{
            $carrinho = array();
        }
        //evita itens duplicados no carrinho, vide função arraySearch acima
        $key = arraySearch($item->getProduto()->getId(), $carrinho);
        if($key != -1){
            $carrinho[$key]->setQuantidade();
            $carrinho[$key]->setValorItem();
        }
        else{
            $carrinho[] = $item;
        }
        $_SESSION['carrinho'] = $carrinho;

        header("Location: ../views/exibirCarrinho.php");
    }

    if($opcao == 2){ //remover do carrinho
        $index = (int)$_REQUEST['index'];

        session_start();
        $carrinho = $_SESSION['carrinho'];

        unset($carrinho[$index]);
        sort($carrinho);

        $_SESSION['carrinho'] = $carrinho;

        header("Location: controllerCarrinho.php?opcao=4");
    }

    if($opcao == 3){
        session_start();

        unset($_SESSION['carrinho']);

        header("Location: controlerProduto.php?opcao=6");
    }

    if($opcao == 4){
        session_start();
        if(!isset($_SESSION['carrinho']) || sizeof($_SESSION['carrinho']) == 0){
            header("Location: ../views/exibirCarrinho.php?status=1");
        }
        else{
            header("Location: ../views/exibirCarrinho.php");
        }
    }


    if($opcao == 5){ //Finalizar Compra
        $total = (float)$_REQUEST['total'];
        session_start();

        $_SESSION['total'] = $total;

        if(isset($_SESSION['cliente'])){ //verificação se está logado ou não
            header("Location: ../views/dadosCompra.php"); //cliente está logado
        }
        else{
            header("Location: ../views/formLogin.php"); //cliente não está logado
        }
    }


?>