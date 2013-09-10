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
            <div id="usuarioTopo">
                
            </div>
            </div>
            <div id="conteudo">
                <div class="wrap">
                    <br/>
                    <br/>
                    <div class="FotoPerfil">
                        <img src="imagem/padrao.png" id="imagePerfil" onload="redimensiona()"/>
                    </div>
                            
                    <div id="NomeUsuTopo">
                        <p id="Nome_usuario">Nome do Usuário</p>
                        <div id="LinksPerfil">
                            <a href="">Publicações</a>
                            <a href="">Fotos</a>
                            <a href="">Músicas</a>
                            <a href="">Vídeos</a>
                        </div>
                    </div>
                    <div id="SobreAutor">
                        <p>Sobre o NomeAutor<p>
                        <div id="TextoSobreAutor">
                            <span>texto sobre o autortexto sobre o autortexto sobre o autor
                                texto sobre o autortexto sobre o autortexto sobre o autor
                                texto sobre o autortexto sobre o autortexto sobre o autor
                                texto sobre o autortexto sobre o autortexto sobre o autor
                                texto sobre o autortexto sobre o autortexto sobre o autor<span>
                        </div>    
                    </div>
                    <div id="PublicRecente">
                        <p>Publicações Recentes</p>
                        <div id="publicR">
                            <p>"Publicação Recente do UsárioPublicação Recente do Usário
                                Publicação Recente do UsárioPublicação Recente do Usário"</p>
                            <p>"Publicação Recente do UsárioPublicação Recente do Usário
                                Publicação Recente do UsárioPublicação Recente do Usário"</p>
                        </div>
                    </div>
                    <div id="Destaques">
                            <p>DESTAQUES</p>
                    </div>
                    <div id="Baixo">
                        
                    </div>
                </div>
            </div>
        </div>
        
        
        
    </body>
    <script type="text/javascript">
          var variaveis=location.search.split("?");
          var quebra = variaveis[1].split("=");
          var login = quebra[1];
          $.ajax({url: "ajax/validar.php",
                            data: {login:login,
                                   acao:"CarregarDados"},
                            type:"POST",
                            async:false,
                            success:function(data){
                                if(data=="sucesso"){
                                    //window.location = 'perfil.php?u=';
                                }else if(data=="erro"){
                                    aviso("Erro","Login ou senha Inválidos!",'ui-icon-alert');
                                }
                            }});
          
          function redimensiona()
            {
                document.images['imagePerfil'].width = 100;
            }
          var delay = (function(){
            var timer = 0;
            return function(callback, ms){
              clearTimeout (timer);
              timer = setTimeout(callback, ms);
            };
          })();
    $(document).ready(function(){    
        $("#q").autocomplete({
            source:"ajax/busca.php?acao=busca_topo",
            minLength:3
        });
    });
    </script>
</html>