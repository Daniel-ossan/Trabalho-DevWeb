<?php
    include_once "../dao/ProdutoDao.inc.php";
    include_once "../classes/produto.inc.php";

    
    $opcao = (int)$_REQUEST['opcao'];

    //Adicionar produto
    if($opcao == 1){ 
        $produto = new Produto();
        $produto->setProduto(
            $_REQUEST['pNome'],
            $_REQUEST['pPreco'],
            $_REQUEST['pEstoque'],
            $_REQUEST['pDescricao'],
            $_REQUEST['pResumo'],
            $_REQUEST['pRef'],
            $_REQUEST['pDataFabricacao'],
            $_REQUEST['pFabricante']);
        header("Location: controlerProduto.php?opcao=2");
    }

    //Selecionar produto
    if (($opcao == 2) || ($opcao==6)) {
        $produtoDao = new ProdutoDao();
        $produtos = $produtoDao->getProdutos();

        session_start();
        $_SESSION['produtos'] = $produtos;
        //var_dump($produtos);
        if($opcao==2){
            header("Location: ../views/exibirProdutos.php");
        }
        else{
            header("Location: ../views/produtosVenda.php");

        }
    }

    //Excluir produto
    if($opcao == 3){
        $id = (int)$_REQUEST['id'];
        $produtoDao = new ProdutoDao();
        $produtoDao->deletarProduto($id);
        header("Location: controlerProduto.php?opcao=2");
    }

    if($opcao==4){
        $id = (int)$_REQUEST['id'];
        $produtoDao = new ProdutoDao();
        $produto = $produtoDao->getProduto($id);
        
        session_start();
        $_SESSION=['produto'];

        header("Location: ../views/formProdutoAtualizar.php");
        
    }

    if($opcao==5){
        $produto = new Produto();
        $produto->setProduto(
            $_REQUEST['pNome'],
            $_REQUEST['pPreco'],
            $_REQUEST['pEstoque'],
            $_REQUEST['pDescricao'],
            $_REQUEST['pResumo'],
            $_REQUEST['pRef'],
            $_REQUEST['pDataFabricacao'],
            $_REQUEST['pFabricante']);
            
            $produtoDao = new ProdutoDao();
            $produtoDao->atualizarProduto($produto);
        header("Location: controlerProduto.php?opcao=2");
    }
?>
