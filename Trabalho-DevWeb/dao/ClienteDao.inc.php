<?php

include_once "conexao.inc.php";

class ClienteDao{
    private $conn;

    function __construct(){
        $c = new Conexao();
        $this->conn = $c->getConexao();
    }

    function autenticar($email, $senha){
        $rs = $this->conn->prepare("select * from clientes where email = :em and senha = :s ");
        $rs -> bindValue(":em", strtolower($email));
        $rs -> bindValue(":s", $senha);
        $rs->execute();

        $cliente = NULL;

        if($rs->rowCount() == 1){ // encontrei o autor
            $cliente = $rs->fetch(PDO::FETCH_OBJ);
        }
        return $cliente;
    }
}
?>