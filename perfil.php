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
                            <label id="num_publicacao"></label><a href="">Publicações</a>
                            <a href="">Fotos</a>
                            <a href="">Músicas</a>
                            <a href="">Vídeos</a>
                        </div>
                    </div>
                    <div id="SobreAutor">
                        <p id="ParAutor">Sobre o NomeAutor<p>
                        <div id="TextoSobreAutor">
                            <span id="descricao_usu" >texto sobre o autortexto sobre o autortexto sobre o autor
                                texto sobre o autortexto sobre o autortexto sobre o autor
                                texto sobre o autortexto sobre o autortexto sobre o autor
                                texto sobre o autortexto sobre o autortexto sobre o autor
                                texto sobre o autortexto sobre o autortexto sobre o autor</span>
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
                                var obj = $.parseJSON(data);
                                $("#Nome_usuario").text(obj.usu_nome);
                                $("#ParAutor").text("Sobre o "+obj.usu_nome);
                                $("#descricao_usu").text(obj.usu_descricao);
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
    
    function divClicked() {
        var divHtml = $(this).html();
        var editableText = $("<textarea style='width: 500px; height: 120px; border: solid; border-color:#FFFF00' />");
        editableText.val(divHtml);
        $(this).replaceWith(editableText);
        editableText.focus();
        // setup the blur event for this new textarea
        editableText.blur(editableTextBlurred);
    }
    
    function editableTextBlurred() {
        var html = $(this).val();
        $.ajax({url: "ajax/validar.php",
                            data: {login:login,
                                   html:html,
                                   acao:"GravarDescricao"},
                            type:"POST",
                            async:false});
        var viewableText = $("<div id='TextoSobreAutor'>");
        viewableText.html(html);
        $(this).replaceWith(viewableText);
        // setup the click event for this new div
        $(viewableText).click(divClicked);
    }
    $("#TextoSobreAutor").click(divClicked);
    </script>
</html>