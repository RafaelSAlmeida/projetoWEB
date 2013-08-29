<?php
include("../php/Conexao.php");
session_start();

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
        }else if($acao == 'validarLogin'){
            $con = new Conexao();
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            $email = $_POST['flag'];
            if($email = true){
                $sql = "SELECT * FROM usuario WHERE usu_email='$login'";
            }else if($email = false){
                $sql = "SELECT * FROM usuario WHERE usu_login='$login'";
            }

            $con->execute_query($sql);
            $result= mysql_num_rows($con->resultado);
            $linha = mysql_fetch_object($con->resultado);
            if($result == 1){
                if(md5($senha) == $linha->usu_senha){
                    $_SESSION['login'] = $login;
                    $_SESSION['senha'] = $linha->usu_senha;
                    echo "sucesso";
                }
                else
                    echo $sql;
            } else
                echo "erro";
            exit;
        }
        
    }else{
        header('Location:../index.php');
    }
?>
