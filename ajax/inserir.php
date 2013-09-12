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
       }else
       if($acao == 'inserir_publicacao'){
           $pub = new Publicacao();
           $pub->pub_autor = $_POST['autor'];
           $pub->pub_data = date("Y-m-d H:m:s");
           $pub->pub_mensagem = $_POST['autor'];
           $pub->pub_n_acesso = $_POST['autor'];
           $pub->pub_tipo_midia = $_POST['autor'];
           $pub->pub_titulo = $_POST['autor'];
           $pub->pub_url = $_POST['autor'];
           $pub->usuario_id = $_POST['autor'];
           
           echo $_POST['q'];
           exit;
       }
    }else{
        header('Location:../index.php');
    }

?>
