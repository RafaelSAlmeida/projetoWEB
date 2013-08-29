<?php
    include("../php/Conexao.php");
    
    if(!empty($_POST)){
        $acao = $_POST['acao'];
       if($acao == 'inserir_usuario'){
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);
        $data_nascimento = $_POST['ano'].'-'.$_POST['mes'].'-'.$_POST['dia'];
        
        $usuario = $_POST['usuario'];
        
        $con = new Conexao();
        
        $sql = "INSERT INTO usuario(usu_nome, usu_sobrenome, usu_login, usu_data_nascimento, usu_email, usu_senha) VALUES
                            ('{$nome}','{$sobrenome}','{$usuario}','{$data_nascimento}','{$email}','{$senha}')";
        $con->execute_query($sql);
        if($con->resultado)
            echo '1';
        else
            echo '0';
        exit;        
       }
    }else{
        header('Location:../index.php');
    }

?>
