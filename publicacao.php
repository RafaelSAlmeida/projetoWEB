<!DOCTYPE html>
<?php
include('php/autoload.php');
include('php/utilitarios.php');
?>
<html>
    <head>
        <title>Publicações - Nome do Usuário</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        
        <link rel="stylesheet" type="text/css" href="css/geral.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.9.2.custom.css" />
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>
    </head>
    <body>
        
        <div id="geral">
            <div id="topo">
                <form class="form-search" action="perfil.php" method="GET">
                    <input type="text" id="q" value="inserir_publicacao">
                    <input type="text" class="textfield inputSearch" id="q" name="q" placeholder="Busca o usuário aqui..." required >
                        
                </form>
            </div>
            <div id="conteudo">
                <div class="wrap">
                
                <div class="bubble" >
                    <div id="dialog-form" title="Enviar Arquivo">
                        <label for="arquivo" id="labelArquivo">Arquivo</label>
                        <input type="file" name="arquivo" id="arquivo" />
                    </div>
                    <textarea id="post" style="width:99%;height:110px;border:none;resize:none;outline:0"></textarea>
                    <img id="imagem" src="imagem/camera.png" height="25px" style="margin-left:10px;"/>
                    <input type="hidden" id="imagemURL"/>
                    <img id="video" src="imagem/video.png" height="25px" style="margin-left:10px;"/>
                    <input type="hidden" id="videoURL"/>
                    <img id="audio" src="imagem/som.png" height="25px" style="margin-left:10px;"/>
                    <input type="hidden" id="audioURL"/>
                    <input type="button" class="button" value="Publicar" id="publicar"/>
                </div>
                    <h3 >Publicações</h3>
                </div>
                
               <form id="formulario" method="post" enctype="multipart/form-data" action="ajax/upload.php">
                Foto
                <input type="file" id="imag" name="imag" />
                </form>
                <div id="visualizar"></div>
                
                <div id="progress">
                    <div id="bar"></div>
                    <div id="percent">0%</div>
                </div>
                
<div id="message"></div>
            </div>
        </div>
        
        
        
    </body>
    <script type="text/javascript">
         $(document).ready(function()
{
 
    /* #imagem Ã© o id do input, ao alterar o conteudo do input execurarÃ¡ a funÃ§Ã£o baixo */
     $('#imag').on('change',function(){
         $('#visualizar').html('<img src="ajax-loader.gif" alt="Enviando..."/> Enviando...');
        /* Efetua o Upload sem dar refresh na pagina */          
        $('#formulario').ajaxForm({
            target:'#visualizar' // o callback serÃ¡ no elemento com o id #visualizar
         }).submit();
     });
 


             
             
             
           $(".button").button();
             $( "#dialog-form" ).dialog({
                autoOpen: false,
                minheight: 200,
                width: 350,
                modal: true,
                resize:false,
                buttons: {
                  "Enviar": function() {
                      $( this ).dialog( "close" );

                  },
                  Cancel: function() {
                    $("#arquivo").val('');
                    $( this ).dialog( "close" );
                  }
                },
                close: function() {
                  
                }
              });
    
    

            $("#q").autocomplete({
                source:"ajax/busca.php?acao=busca_topo",
                minLength:3
            });
            
            $("#imagem").click(function(){
                 
               if($(this).attr("src")==="imagem/camera_azul.png")
               {
                    $("#audio").attr("src","imagem/som.png");
                    $("#video").attr("src","imagem/video.png");
                    $("#imagem").attr("src","imagem/camera.png");
               }else{
                    $("#labelArquivo").text("");
                    $("#labelArquivo").text("Selecione Imagem:");
                    $( "#dialog-form" ).dialog( "open" );
                    $("#audio").attr("src","imagem/som_cinza.png");
                    $("#video").attr("src","imagem/video_cinza.png");
                    $("#imagem").attr("src","imagem/camera_azul.png");}
            });
            
            $("#video").click(function(){
                $("#audio").attr("src","imagem/som_cinza.png");
                $("#video").attr("src","imagem/video_azul.png");
                $("#imagem").attr("src","imagem/camera_cinza.png");
            });
            
            $("#audio").click(function(){
                $("#audio").attr("src","imagem/som_azul.png");
                $("#video").attr("src","imagem/video_cinza.png");
                $("#imagem").attr("src","imagem/camera_cinza.png");
            });
            
            $("#publicar").click(function(){
                $.ajax({url: "ajax/inserir.php",
                        data: $('#q').serialize(),
                        type:"POST",
                        async:false,
                        success:function(data){
                            console.log(data);
                            if(data==='1')
                            {
                                aviso("Aviso","Cadastro Realizado com Sucesso",'ui-icon-check');
                                //window.location = 'perfil.php?u=';
                            }
                            else{
                                aviso("Aviso","Erro durante a publicação!",'ui-icon-alert');
                            }
                        }});
                    
            });
            
            
         });
    </script>
</html>
