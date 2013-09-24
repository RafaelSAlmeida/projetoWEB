<!DOCTYPE html>
<?php
include('php/autoload.php');
include('php/utilitarios.php');

$id_usuario = 1;
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
            width:100%;
            height:100%;
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
                    <div id="left">
                        <div id="infoUsuario">
                            <div class="foto_perfil">
                                <img src="imagem/padrao.png" id="imagePerfil" style="width:100px;"/>
                                <form id="form" method="post" enctype="multipart/form-data" action="ajax/upload.php">
                                    <input type="file" id="imag" name="imag" style="display:none;"/>
                                </form>
                            </div>

                            <div id="info_pessoal_usuario">
                                <p>Nome do Usuário</p>
                                <br/>
                                <div id="perfilCnt">
                                    <div class="linkCnt">
                                        <a href="#">Publicações</a><br/>
                                        <span id="pubCnt" >3132132</span>
                                    </div>
                                    <div class="linkCnt">
                                        <a href="">Fotos</a><br/>
                                        <span id="pubCnt" >3132132</span>
                                    </div>
                                    <div class="linkCnt">
                                        <a href="">Músicas</a><br/>
                                        <span id="pubCnt" >3132132</span>
                                    </div>

                                    <div class="linkCnt">
                                        <a href="">Vídeos</a><br/>
                                        <span id="pubCnt" >3132132</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="bubble" >
                            <form id="formulario" method="post" enctype="multipart/form-data" action="ajax/inserir.php">
                                <input type="file" id="arq" name="arq" style="display:none;"/> 
                                <textarea id="post" name="post" style="width:99%;height:80px;border:none;resize:none;outline:0"></textarea>
                                <img id="imagem" src="imagem/camera.png" height="25px" style="margin-left:10px;float:left;"/>
                                <img id="video" src="imagem/video.png" height="25px" style="margin-left:10px;float:left;"/>
                                <img id="audio" src="imagem/som.png" height="25px" style="margin-left:10px;float:left;"/>
                                <div id="progressbar"><div class="progress-label"></div></div>
                                <input name="tipo_arquivo" id="tipo_arquivo" type="hidden"/>
                                <input name="acao" id="acao" type="hidden" value="inserir_publicacao"/>
                                <input name="usuario" id="usuario" type="hidden" value="<?=$id_usuario?>"/>
                                <input type="button" class="button" value="Publicar" id="publicar"/>
                            </form>

                        </div> 

                        <center>
                            <hr ></hr>
                        </center>
                        
                    </div>
                    <div id="right">
                        colocar atualizações de todo mundo!!
                        utilizar periodic refresh
                    </div>
                </div>
                
            </div>
        </div>
        
        
        
    </body>
    <script type="text/javascript">
        
        
   $(document).ready(function(){
    var progressbar = $("#progressbar"),
        progressLabel = $(".progress-label");
    var sucesso = true;
        progressbar.progressbar({
         value: false,
         change: function() {
           progressLabel.text( progressbar.progressbar( "value" ) + "%" );
         }
       });
   
        $(".button").button();
        $("#q").autocomplete({
            source:"ajax/busca.php?acao=busca_topo",
            minLength:3
        });
        
        $("#publicar").click(function(){
            
            if($("#post").val()!==""){
                $(this).hide();
                $(".ui-progressbar").show();
                $('#formulario').ajaxForm({
                    uploadProgress: function(event, position, total, percentComplete) { //on progress

                                progressbar.progressbar( "value", percentComplete );

                     },
                    complete: function(response) { // on complete
                        if(response.responseText){
                            aviso("Aviso",response.responseText,'ui-icon-notice');
                            progressbar.hide();
                            $("#publicar").show();
                            $("#tipo_arquivo").val("");
                            $("#arq").val("");
                            $("#audio").attr("src","imagem/som.png");
                            $("#video").attr("src","imagem/video.png");
                            $("#imagem").attr("src","imagem/camera.png");
                        }
                        else
                            location.reload();
                    }
                 }).submit(); 
             }else{
                aviso("Aviso","Falta o POST Mano!",'ui-icon-notice');
             }
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
                $("#arq").click();
                
            }
           
        });
            $("#arq").change(function(){
                
               
            });
            $("#video").click(function(){
                if($(this).attr("src")==="imagem/camera_azul.png")
                {
                     $("#tipo_arquivo").val("");
                     $("#audio").attr("src","imagem/som.png");
                     $("#video").attr("src","imagem/video.png");
                     $("#imagem").attr("src","imagem/camera.png");
                }else{
                     $("#tipo_arquivo").val("video");
                     $("#audio").attr("src","imagem/som_cinza.png");
                     $("#video").attr("src","imagem/video_azul.png");
                     $("#imagem").attr("src","imagem/camera_cinza.png");
                     $("#arq").click();
                 }
            });
            
            $("#audio").click(function(){
                if($(this).attr("src")==="imagem/camera_azul.png")
                {
                     $("#tipo_arquivo").val("");
                     $("#audio").attr("src","imagem/som.png");
                     $("#video").attr("src","imagem/video.png");
                     $("#imagem").attr("src","imagem/camera.png");
                }else{
                     $("#tipo_arquivo").val("audio");
                     $("#audio").attr("src","imagem/som_azul.png");
                     $("#video").attr("src","imagem/video_cinza.png");
                     $("#imagem").attr("src","imagem/camera_cinza.png");
                     $("#arq").click();
                 }
                
            });
            
           
            
            
         });
    </script>
</html>
