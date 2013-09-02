
<?php
include('php/autoload.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <title>Busca de Usuário</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        
        <link rel="stylesheet" type="text/css" href="css/geral.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.9.2.custom.css" />
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
    </head>
    <body>
        <div id="geral">
            <div id="topo">
                <form class="form-search" action="" method="GET">
    
                        <input type="text" class="textfield" id="q" name="q" placeholder="Busca o produto aqui..." required>
                        <button type="submit" class="submit">BUSCAR</button>
                </form>
            </div>
            <div id="conteudo">
                <div class="wrap">
                    <br/>
                    <br/>
                    <b>Resultado:</b>
                    <span id="nResultado">0</span>
                    
                    <div class="resultados">
                        <br/><br/>
                        <div class="qResultado">
                            <img src="imagem/padrao.png" class="image"/>
                            <div class="infoResultado">
                                <p class="infoUsuario">Busca usuario</p>
                                <p style="text-indent:10px;">Publicações Recentes:</p>
                                <p class="infoPublic">Publicação 1 - Autor<span class="infoMidia">[midia]</span></p>
                                <p class="infoPublic">Publicação 1 - Autor<span class="infoMidia">[midia]</span></p>
                                <p class="infoPublic">Publicação 1 - Autor<span class="infoMidia">[midia]</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
    </body>
    <script type="text/javascript">
          var delay = (function(){
            var timer = 0;
            return function(callback, ms){
              clearTimeout (timer);
              timer = setTimeout(callback, ms);
            };
          })();
    $(document).ready(function(){    
    $("#q").keyup(function(){
        if($(this).val()!=''){
        delay(function(){
        $.ajax({url: "ajax/busca.php",
                data: {q:$("#q").val(),
                       acao:"busca_usuario"},
                type:"POST",
                async:false,
                success:function(data){
                    $(".qResultado").remove();
                    var obj = $.parseJSON(data).object_name;
                    if(obj)
                        $("#nResultado").text(obj.length);
                    else
                        $("#nResultado").text("0");
                    for (var i in obj){
                            //navego pelas chaves do array como um for
                            
                            $(".resultados").append('<div class="qResultado">'
                                                    +'<img src="imagem/'+obj[i].usu_foto+'" class="image"/>'
                                                    +'<div class="infoResultado">'
                                                    +'<p class="infoUsuario">'+obj[i].usu_nome+' '+obj[i].usu_sobrenome+'</p>'
                                                    +'<p style="text-indent:10px;">Publicações Recentes:</p>'
                                                    +'</div>'
                                                    +'</div>');
                           
                    }
                }});   
      }, 1000 );
      }
          
           
        });
    });
    </script>
</html>
