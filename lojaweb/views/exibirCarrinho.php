<?php
    require_once '../classes/item.inc.php';
    require_once 'includes/cabecalho.inc.php';


    $carrinho = $_SESSION['carrinho'];
?>

<h1 class="text-center">Carrinho de compra</h1>
<p> 

<?php // validação de carrinho vazio
     if (isset($_REQUEST['status'])){
            require_once "includes/carrinhoVazio.inc.php";
     }
     else{
?>
<div class="table-responsive">
<table class="table table-ligth table-striped">
      <thead class="table-danger">
            <tr class="align-middle" style="text-align: center">
                <th witdh="10%">Item No</th>
                <th>Ref.</th>
                <th>Nome</th>
                <th>Fabricante</th>
                <th>Preço</th>
                <th>Qde.</th>
                <th>Total</th>                
                <th>Remover</th>
            </tr>
      </thead>
      <tbody class="table-group-divider">
      <?php
      //percurso inicia aqui
            $cont = 1;
            $soma = 0;
            foreach($carrinho as $item){           
      ?>
            <tr class="align-middle" style="text-align: center">
                  <td><?= $cont; ?></td>
                  <td><?= $item->getProduto()->getId() ?></td>
                  <td><?= $item->getProduto()->getNome() ?></td>
                  <td><?= $item->getProduto()->getCodFabricante() ?></td>
                  <td><?= number_format($item->getProduto()->getPreco()) ?></td>
                  <td><?= $item->getQuantidade() ?></td>
                  <td>R$ <?= number_format($item->getValorItem()) ?></td>
                  <td><a href="../controlers/controllerCarrinho.php?opcao=2&index=<?=$cont-1?>" class='btn btn-danger btn-sm'>X</a></td>
                  
            </tr>

      <?php
      //percurso acaba aqui
            $soma += $item->getValorItem();
            $cont++;
         }
      ?>
         
            <tr align="right"><td colspan="8"><font face="Verdana" size="4" color="red"><b>Valor Total = R$ <?= number_format($soma) ?></b></font></td></tr>
      </table> 
      <div class="container text-center">
            <div class="row">
                  <div class="col">
                        <a class="btn btn-warning" role="button" href="../controlers/controlerProduto.php?opcao=6"><b>Continuar comprando</b></a>
                  </div>
                  <div class="col">
                        <a class="btn btn-danger" role="button" href="../controlers/controllerCarrinho.php?opcao=3"><b>Esvaziar carrinho</b></a>
                  </div>
                  <div class="col">
                        <a class="btn btn-success" role="button" href="../controlers/controllerCarrinho.php?opcao=5&total=<?= $soma ?>"><b>Finalizar compra</b></a>
                  </div>
            </div>
      </div>
      <?php } //fim do else que verifica se o carrinho está vazio ou não?> 

<?php
     require_once 'includes/rodape.inc.php';
?>