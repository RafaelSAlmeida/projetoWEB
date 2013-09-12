<?php
//upload.php

    $pasta = "../imagem/";
    
    /* formatos de imagem permitidos */
    $permitidos = array("jpg","jpeg","gif","png", "bmp");
    
    if(isset($_POST)){
        $nome_imagem    = $_FILES['imag']['name'];
        $tamanho_imagem = $_FILES['imag']['size'];
        /* pega a extensÃ£o do arquivo */
        
        $tamanho  = strlen($nome_imagem);
		$ext = substr($nome_imagem,-3,$tamanho);
        
        /*  verifica se a extensÃ£o estÃ¡ entre as extensÃµes permitidas */
        if(in_array($ext,$permitidos)){
                
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
            
            if($tamanho < 300000){ //se imagem for atÃ© 1MB envia
                $nome_atual = md5(uniqid(time())).".".$ext; //nome que darÃ¡ a imagem
                $tmp = $_FILES['imag']['tmp_name']; //caminho temporÃ¡rio da imagem
                /* se enviar a foto, insere o nome da foto no banco de dados */
                if(move_uploaded_file($tmp,$pasta.$nome_atual)){
                    echo "<img src='imagem/".$nome_atual."' id='previsualizar'>"; //imprime a foto na tela
                }else{
                    echo "Falha ao enviar";
                }
            }else{
                echo "A imagem deve ser de no mÃ¡ximo 1MB";
            }
        }else{
            echo "Somente sÃ£o aceitos arquivos do tipo Imagem".$ext;
        }
    }else{
        echo "Selecione uma imagem";
        exit;
    }
?>
