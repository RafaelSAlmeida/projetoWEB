<?php
    include("../php/autoload.php");
    
    if(!empty($_POST)){
        $acao = $_POST['acao'];
       if($acao == 'inserir_usuario'){
        $usu = new Usuario();
        $usu->usu_nome = $_POST['nome'];
        $usu->usu_sobrenome = $_POST['sobrenome'];
        $usu->usu_email = $_POST['email'];
        $usu->usu_senha = md5($_POST['senha']);
        $usu->usu_data_nascimento = $_POST['ano'].'-'.$_POST['mes'].'-'.$_POST['dia'];
        $usu->usu_login = $_POST['usuario'];
        
        $usu->insereUsuario();
        if($usu->conn->resultado)
            echo '1';
        else
            echo '0';
        exit;        
       }
    }else{
        header('Location:../index.php');
    }

?>
