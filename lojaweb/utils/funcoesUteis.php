<?php

    function formatarData($data){
        return date('d/m/Y',$data);
    }

    function converteDataMySql($data){
        return date('Y-m-d', $data);
    }

?>