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
           try{
           $pub = new Publicacao();
           
           $tipo_arquivo = $_POST['tipo_arquivo'];
           $pasta = "";
           $permitidos = "";
           //0 - imagem 1 - audio 2 - video
           $tipo_midia = "";
           $sucesso = false;
           
           if($tipo_arquivo =="imagem"){
                $tipo_midia = 0;
                $pasta = "../imagem/";
                $permitidos = array("jpg","jpeg","gif","png", "bmp","JPG","JPEG","GIF","PNG", "BMP");
           }else
           if($tipo_arquivo =="audio"){
                $tipo_midia = 1;
                $pasta = "../audio/";
                $permitidos = array("mp3","MP3");
           }else
           if($tipo_arquivo =="video"){
                $tipo_midia = 2;
                $pasta = "../video/";
                $permitidos = array("wmv","WMV","mp4","MP4");
           }
           $tipo_midia = -1;
           $nome_atual = '';
           if($_FILES['arq']){
                include("upload.php");
           }
           
           $pub->pub_autor = "";
           $pub->pub_data = date("Y-m-d H:m:s");
           $pub->pub_mensagem = $_POST['post'];
           $pub->pub_n_acesso = 0;
           $pub->pub_tipo_midia = $tipo_midia;
           $pub->pub_titulo = "";
           $pub->pub_url = $nome_atual;
           $pub->usuario_id = $_POST['usuario'];
           $pub->inserePublicacao();
           $mensagem = NULL;
           }catch(Exception $e)
           {
               $mensagem =  "[ERRO]".$e.getMessage();
           }
           die($mensagem);
           exit;
       }
    }else{
        header('Location:../index.php');
    }

?>
