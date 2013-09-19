<?php
$nome_imagem    = $_FILES['arq']['name'];
$tamanho_imagem = $_FILES['arq']['size'];

$tamanho  = strlen($nome_imagem);
$ext = substr($nome_imagem,-3,$tamanho);

if(in_array($ext,$permitidos)){

    $tamanho = round($tamanho_imagem / 1024);

    if($tamanho < 300000){
        $nome_atual = md5(uniqid(time())).".".$ext; 
        $tmp = $_FILES['arq']['tmp_name']; 
       
        if(move_uploaded_file($tmp,$pasta.$nome_atual)){
            $sucesso = true; //imprime a foto na tela
        }else{
            die("Falha ao enviar");
        }
    }else{
        die("A imagem deve ser de no máximo 1MB");
    }
}else{
    die("Somente são aceitos arquivos do tipo {$tipo_arquivo}!");
}
?>
