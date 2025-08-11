<?php
    include_once "conexao.inc.php";
    include_once "../classes/produto.inc.php";
    include_once "../utils/funcoesUteis.php";

    class ProdutoDao{
        private $conn;

        function __construct(){
            $c = new Conexao();
            $this->conn = $c->getConexao();
        }

        public function adicionarProduto(Produto $produto){
            $sql = $this->conn->prepare(
                "insert into produtos (
                    nome, preco, estoque, descricao, resumo, referencia, data_fabricacao, cod_fabricante
                ) values (
                    :nome, :preco, :est, :desc, :res, :ref, :dtFab, :codFab)");

            $sql->bindValue(':nome', $produto->getNome());
            $sql->bindValue(":preco", $produto->getPreco());
            $sql->bindValue(":est", $produto->getEstoque());
            $sql->bindValue(":desc", $produto->getDescricao());
            $sql->bindValue(":res", $produto->getResumo());
            $sql->bindValue(":ref", $produto->getRef());
            $sql->bindValue(':dtFab', converteDataMySql($produto->getDtFabricacao()));
            $sql->bindValue(":codFab", $produto->getCodFabricante());

            $sql->execute();
        }

        public function deletarProduto($id){
            $sql = $this->conn->prepare("delete from produtos where produto_id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
        }

        public function atualizarProduto(Produto $produto){
            $sql = $this->conn->prepare("update produtos set nome = :nome,
                                        preco = :preco,
                                        estoque = :est,
                                        descricao=:desc,
                                        resumo= :res,
                                        dtFabricacao= :dtFab,
                                        codFabricante= :codFab
                                        where produto_id= :id");
            $sql->bindValue(':id', $produto->getId());
            $sql->bindValue(':nome', $produto->getNome());
            $sql->bindValue(':descricao', $produto->getDescricao());
            $sql->bindValue(':data_fabricacao', converteDataMysql($produto->getDtFabricacao()));
            $sql->bindValue(':resumo', $produto->getResumo());
            $sql->bindValue(':preco', $produto->getPreco());
            $sql->bindValue(':estoque', $produto->getEstoque());
            $sql->bindValue(':cod_fabricante', $produto->getCodFabricante());
            $sql->execute();
        }

        public function getProduto($id){
            $rs = $this->conn->prepare("select * from produtos where produto_id = :id");
            $rs->bindValue('id', $id);
            $rs->execute();

            $row = $rs->fetch(PDO::FETCH_OBJ);
            $produto = new Produto();
            $produto->setId($row->produto_id);
            $produto->setNome($row->nome);
            $produto->setPreco($row->preco);
            $produto->setEstoque($row->estoque);
            $produto->setDescricao($row->descricao);
            $produto->setResumo($row->resumo);
            $produto->setRef($row->referencia);
            $produto->setDtFabricacao($row->data_fabricacao);
            $produto->setCodFabricante($row->cod_fabricante);

            return $produto;
            
        }

        public function getProdutos(){
            $rs = $this->conn->query("select * from produtos");
            
            $lista = array();
            while($row = $rs->fetch(PDO::FETCH_OBJ)){
                $produto = new Produto();
                $produto->setId($row->produto_id);
                $produto->setNome($row->nome);
                $produto->setPreco($row->preco);
                $produto->setEstoque($row->estoque);
                $produto->setDescricao($row->descricao);
                $produto->setResumo($row->resumo);
                $produto->setRef($row->referencia);
                $produto->setDtFabricacao($row->data_fabricacao);
                $produto->setCodFabricante($row->cod_fabricante);
                $lista[] = $produto;
            }
            return $lista;
        }
    }

?>
