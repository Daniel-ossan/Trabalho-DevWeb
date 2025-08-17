<?php

    class Produto{
        private string $id;
        private string $nome;
        private float $preco;
        private int $estoque;
        private string $descricao;
        private string $resumo;
        private string $ref;
        private string $dtFabricacao;
        private int $codFabricante;

        public function setProduto($nome, $preco, $estoque, $descricao, $resumo, $ref, $dtFabricacao, $codFabricante){
            $this->nome = $nome;
            $this->preco = $preco;
            $this->estoque = $estoque;
            $this->descricao = $descricao;
            $this->resumo = $resumo;
            $this->ref = $ref;
            $this->dtFabricacao = strtotime($dtFabricacao);
            $this->codFabricante = $codFabricante;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            return $this->id = $id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            return $this->nome = $nome;
        }

        public function getDtFabricacao(){
            return $this->dtFabricacao;
        }

        public function setDtFabricacao($dtFabricacao){
            return $this->dtFabricacao = strtotime($dtFabricacao);
        }

        public function getPreco(){
            return $this->preco;
        }

        public function setPreco($preco){
            return $this->preco = $preco;
        }

        public function getEstoque(){
            return $this->estoque;
        }

        public function setEstoque($estoque){
            return $this->estoque = $estoque;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function setDescricao($descricao){
            return $this->descricao = $descricao;
        }

        public function getResumo(){
            return $this->resumo;
        }

        public function setResumo($resumo){
            return $this->resumo = $resumo;
        }

        public function getRef(){
            return $this->ref;
        }

        public function setRef($ref){
            return $this->ref = $ref;
        }

        public function getCodFabricante(){
            return $this->codFabricante;
        }

        public function setCodFabricante($codFabricante){
            return $this->codFabricante = $codFabricante;
        }


    }

?>
