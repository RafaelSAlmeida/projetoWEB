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
                        <input type="text" id="t">
                </form>
            <div id="usuarioTopo">
                
            </div>
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
        var resultado;
        if($(this).val()!=''){
        delay(function(){
             $('#t').autocomplete(
                {
                 source: "ajax/busca.php?acaoGET=busca_topo"
                });
      }, 1000 );
      resultado = "";
      }
          
           
        });
    });
    </script>
</html>