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
        <style type="text/css">
          .ui-progressbar {
            position: relative;
            width: 79px;
            height: 28px;
            float: right;
            display:none;
          }
          .progress-label {
            position: absolute;
            text-align: center;
            top: 4px;
            font-weight: bold;
            text-shadow: 1px 1px 0 #fff;
          }
        </style>
    </head>
    <body>
        
        <div id="geral">
            <div id="topo">
                <form class="form-search" action="perfil.php" method="GET">
                    <input type="text" class="textfield inputSearch" id="q" name="q" placeholder="Busca o usuário aqui..." required >
                </form>
                
            </div>
            <div id="conteudo">
                <div class="wrap">
                
                <div class="bubble" >
                    <form id="formulario" method="post" enctype="multipart/form-data" action="ajax/upload.php">
                        <input type="file" id="imag" name="imag" style="display:none;"/> 
                        <textarea id="post" style="width:99%;height:110px;border:none;resize:none;outline:0"></textarea>
                        <img id="imagem" src="imagem/camera.png" height="25px" style="margin-left:10px;float:left;"/>
                        <img id="video" src="imagem/video.png" height="25px" style="margin-left:10px;float:left;"/>
                        <img id="audio" src="imagem/som.png" height="25px" style="margin-left:10px;float:left;"/>
                        <div id="progressbar"><div class="progress-label">Loading...</div></div>
                        <input name="tipo_arquivo" id="tipo_arquivo" type="text" />
                        <input type="button" class="button" value="Publicar" id="publicar"/>
                    </form>
                    
                </div>
                    <h3 >Publicações</h3>
                </div>
                
            </div>
        </div>
        
        
        
    </body>
    <script type="text/javascript">
   $(document).ready(function(){
    var progressbar = $("#progressbar"),
        progressLabel = $(".progress-label");
 
        progressbar.progressbar({
         value: false,
         change: function() {
           progressLabel.text( progressbar.progressbar( "value" ) + "%" );
         },
         complete: function() {
           progressLabel.text( "Publicado" );
         }
       });
   
        $(".button").button();
        $("#q").autocomplete({
            source:"ajax/busca.php?acao=busca_topo",
            minLength:3
        });
        
        $("#publicar").click(function(){
            $(this).hide();
            $(".ui-progressbar").show();
            $('#formulario').ajaxForm({
                uploadProgress: function(event, position, total, percentComplete) { //on progress

                            progressbar.progressbar( "value", percentComplete );

                 },
                complete: function(response) { // on complete
                    alert(response.responseText);
                }
             }).submit(); 
        });    
        $("#imagem").click(function(){

           if($(this).attr("src")==="imagem/camera_azul.png")
           {
                $("#tipo_arquivo").val("");
                $("#audio").attr("src","imagem/som.png");
                $("#video").attr("src","imagem/video.png");
                $("#imagem").attr("src","imagem/camera.png");
           }else{
                $("#tipo_arquivo").val("imagem");
                $("#audio").attr("src","imagem/som_cinza.png");
                $("#video").attr("src","imagem/video_cinza.png");
                $("#imagem").attr("src","imagem/camera_azul.png");
                $("#imag").click();
            }
           
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
            
           
            
            
         });
    </script>
</html>
