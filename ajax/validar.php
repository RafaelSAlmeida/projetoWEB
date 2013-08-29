<?php
include("../php/Conexao.php");


    if(!empty($_POST)){
        
        $acao = $_POST['acao'];
        if($acao == "validarEmail"){
            $email = $_POST['email'];

            $con = new Conexao();

            $sql = "SELECT * 
                    FROM usuario 
                    WHERE usu_email = '{$email}'";
            $con->execute_query($sql);
            echo mysql_num_rows($con->resultado);
            exit;        
        }else
        if($acao == "validarUsuario"){
            $login = $_POST['login'];

            $con = new Conexao();

            $sql = "SELECT * 
                    FROM usuario 
                    WHERE usu_login = '{$login}'";
            $con->execute_query($sql);
            echo mysql_num_rows($con->resultado);
            exit;        
        }
    }else{
        header('Location:../index.php');
    }
?>
