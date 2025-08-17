<?php
    class Venda{
        private $id_venda;
        private $cpf;
        private $valorTotal;
        private $data;


        public function __construct($cpf, $valor){
            $this->cpf = $cpf;
            $this->valorTotal = $valor;
            $this->data = time();
        }

        public function getIdVenda(){
            return $this->id_venda;
        }

        public function getCpf(){
            return $this->cpf;
        }

        public function setCpf($cpf){
            $this->cpf = $cpf;
        }

        public function getValorTotal(){
            return $this->valorTotal;
        }

        public function setValorTotal($valor){
            $this->valorTotal = $valor;
        }

        public function getData(){
            return $this->data;
        }
    }


?>