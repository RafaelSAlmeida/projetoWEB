<?php
include('php/autoload.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <title>Perfil</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        
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
                <form class="form-search" action="" method="GET">
    
                        <input type="text" class="textfield" id="q" name="q" placeholder="Busca o produto aqui..." required>
                        
                </form>
            <div id="usuarioTopo">
                <img src="imagem/padrao.png" id="imagePerfilTopo" onload="redimensionaTopo()"/>
                <span id="usuario_topo"></span>
                <div id="myjquerymenu" class="jquerycssmenu">
                    <ul>
                        <li><a href="#"><img src="imagem/engrenagem.jpg" width="30px"/></a>
                          <ul>
                              <li id="Sair"><a href="ajax/validar.php?acao=QuebraSessao">Sair</a></li>
                          </ul>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
            <div id="conteudo" style="background-image: url('imagem/imagem-perfil4.jpg'); overflow: auto;">
                <div class="wrap" style="background-color: #FFFFFF;">
                    <br/>
                    <br/>
                    <div class="FotoPerfil">
                        <img src="imagem/padrao.png" id="imagePerfil" onload="redimensiona()"/>
                        <form id="formulario" method="post" enctype="multipart/form-data" action="ajax/upload.php">
                            <input type="file" id="imag" name="imag" style="display:none;"/>
                            <input type="button" class="button" value="Salvar" id="salvar"/>
                        </form>
                
                        <div id="progress" style="display: none;">
                            <div id="bar"></div>
                            <div id="percent">0%</div>
                        </div>

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
                                $("#usuario_topo").text(obj.usu_nome);
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
          
          function redimensionaTopo()
            {
                document.images['imagePerfilTopo'].width = 50;
            }
        
    $(document).ready(function(){
        $("#imagePerfil").click(function(){
            $("#imag").click();
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
            $('#imag').live('change', function() {
                $("#salvar").click(function(){
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
            });
            
        });
        
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
    
    //Jquery Menu
    var arrowimages={down:['downarrowclass', 'css/images/arrow-down.gif', 25]}
    var jquerycssmenu={

    fadesettings: {overduration: 350, outduration: 100}, //duration of fade in/ out animation, in milliseconds

    buildmenu:function(menuid, arrowsvar){
            jQuery(document).ready(function($){
                    var $mainmenu=$("#"+menuid+">ul")
                    var $headers=$mainmenu.find("ul").parent()
                    $headers.each(function(i){
                            var $curobj=$(this)
                            var $subul=$(this).find('ul:eq(0)')
                            this._dimensions={w:this.offsetWidth, h:this.offsetHeight, subulw:$subul.outerWidth(), subulh:$subul.outerHeight()}
                            this.istopheader=$curobj.parents("ul").length==1? true : false
                            $subul.css({top:this.istopheader? this._dimensions.h+"px" : 0})
                            $curobj.children("a:eq(0)").css(this.istopheader? {paddingRight: arrowsvar.down[2]} : {}).append(
                                    '<img src="'+ (this.istopheader? arrowsvar.down[1] : arrowsvar.right[1])
                                    +'" class="' + (this.istopheader? arrowsvar.down[0] : arrowsvar.right[0])
                                    + '" style="border:0;" />'
                            )
                            $curobj.hover(
                                    function(e){
                                            var $targetul=$(this).children("ul:eq(0)")
                                            this._offsets={left:$(this).offset().left, top:$(this).offset().top}
                                            var menuleft=this.istopheader? 0 : this._dimensions.w
                                            menuleft=(this._offsets.left+menuleft+this._dimensions.subulw>$(window).width())? (this.istopheader? -this._dimensions.subulw+this._dimensions.w : -this._dimensions.w) : menuleft
                                            $targetul.css({left:menuleft+"px"}).fadeIn(jquerycssmenu.fadesettings.overduration)
                                    },
                                    function(e){
                                            $(this).children("ul:eq(0)").fadeOut(jquerycssmenu.fadesettings.outduration)
                                    }
                            ) //end hover
                    }) //end $headers.each()
                    $mainmenu.find("ul").css({display:'none', visibility:'visible'})
            }) //end document.ready
    }
    }

    //build menu with ID="myjquerymenu" on page:
    jquerycssmenu.buildmenu("myjquerymenu", arrowimages)
     
    </script>
</html>