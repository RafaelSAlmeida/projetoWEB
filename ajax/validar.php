<?php
include("../php/autoload.php");
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
            $check = $_POST['check'];
            if($email == "false"){
                $sql = "SELECT * FROM usuario WHERE usu_login='$login'";
            }else if($email == "true"){
                $sql = "SELECT * FROM usuario WHERE usu_email='$login'";
            }

            $con->execute_query($sql);
            $result= mysql_num_rows($con->resultado);
            $linha = mysql_fetch_object($con->resultado);
            if($result == 1){
                if(md5($senha) == $linha->usu_senha){
                    $_SESSION['login'] = $login;
                    $_SESSION['senha'] = $linha->usu_senha;
                    if($check == "true"){
                        setcookie("usuario", $login,  time()+60*60*24*30);
                    }
                    echo "sucesso";
                }
                else
                    echo "erro";
            } else
                echo "erro";
            exit;
        }else if($acao == 'validarCookie'){
            if($_COOKIE['usuario']){
                echo "sucesso";
            }
        }else if($acao == 'CarregarDados'){
            //$con = new Conexao();
            
            $login = $_POST['login'];
            $usu = new Usuario();
            $usu->carregaUsuario(""," usu_login = '{$login}' ");
            //$sql = " SELECT * FROM usuario WHERE usu_login = '$login' ";
            //$con->execute_query($sql);
            $Usuario = mysql_fetch_object($usu->conn->resultado);
            
            echo json_encode($Usuario);
        }else if($acao == "GravarDescricao"){
            $con = new Conexao();
            
            $login = $_POST['login'];
            $descricao = $_POST['html'];
            $sql = " UPDATE usuario SET usu_descricao = '$descricao' WHERE usu_login = '$login' ";
            $con->execute_query($sql);
            
        }else if($acao == "QuebraSessao"){
            if($_COOKIE['usuario']){
                setcookie("usuario");
                session_unset();
            }
            else{
                session_unset();
            }
        }
    }else{
        header('Location:../index.php');
    }
?>
