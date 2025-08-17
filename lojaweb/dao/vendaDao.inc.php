<?php
include_once "conexao.inc.php";
include_once "../classes/venda.inc.php";
include_once "../classes/item.inc.php";
include_once "../utils/funcoesUteis.php";

class VendaDao
{
    private $conn;
    function __construct()
    {
        $c = new Conexao();
        $this->conn = $c->getConexao();
    }

    public function incluirVenda($venda, $carrinho){
        $sql = $this->conn->prepare("insert into vendas (cpf_cliente, dataVenda, valorTotal)
        values (:cpf, :data, :valor");

        $sql->bindValue(":cpf", $venda->getCpf());
        $sql->bindValue(":data", converteDataMySql($venda->getData()));
        $sql->bindValue(":valor", $venda->getValorTotal());
        $sql->execute();

        $id = $this->getIdVenda();
        $this->incluirItens($id, $carrinho);
    }

    public function incluirItens($idVenda, $carrinho){

        foreach($carrinho as $item){
            $sql = $this->conn->prepare("insert into itens (id_produto, quantidade, valorTotal, idVenda)
            values (:idProduto, :qtd, :valorTotal, :idVenda)");

            $sql->bindValue(":idProduto", $item->getProduto()->getId());
            $sql->bindValue(":qtd", $item->getQuantidade());
            $sql->bindValue(":valorTotal", $item->getValorItem());
            $sql->bindValue(":idVenda", $item->getValorItem());
            $sql->execute();
        }
    }

    public function getIdVenda(){
        $sql = $this->conn->query("select MAX(id_venda) as maior from vendas");
        $row = $sql->fetch(PDO::FETCH_OBJ);
        return $row->maior;
    }
}
