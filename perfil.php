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
        <style>
  .thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
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
                <label id="usuario_topo"></label>
                <div id="myjquerymenu" class="jquerycssmenu">
                    <ul>
                        <li><a href="#">Configurações</a>
                          <ul>
                              <li id="Sair"><a href="ajax/validar.php?acao=QuebraSessao">Sair</a></li>
                          </ul>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
            <div id="conteudo">
                <div class="wrap">
                    <br/>
                    <br/>
                    <div class="FotoPerfil">
                        <img src="imagem/padrao.png" id="imagePerfil" onload="redimensiona()"/>
                        <form id="formulario" method="post" enctype="multipart/form-data" action="ajax/upload.php">
                        <input type="file" class="none" name="imag" />
                        </form>
                        <div id="visualizar"></div>

                        <div id="progress">
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
        
        <input type="file" id="files" name="files[]" multiple />
        <output id="list"></output>
        
    </body>
    <script>
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>
    <script type="text/javascript">
          
         /* #imagem Ã© o id do input, ao alterar o conteudo do input execurarÃ¡ a funÃ§Ã£o baixo */
         $('#imag').on('change',function(){
             $('#visualizar').html('<img src="ajax-loader.gif" alt="Enviando..."/> Enviando...');
            /* Efetua o Upload sem dar refresh na pagina */          
            $('#formulario').ajaxForm({
                target:'#visualizar' // o callback serÃ¡ no elemento com o id #visualizar
             }).submit();
            });
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
            $(".none").click();
            //$("#progress").css("display","block");
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
    
    //Jquery Menu!
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