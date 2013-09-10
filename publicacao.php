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
                
                </div>
            </div>
        </div>
        
        
        
    </body>
    <script type="text/javascript">
         $(document).ready(function(){
           $(".button").button();
            
            $("#q").autocomplete({
                source:"ajax/busca.php?acao=busca_topo",
                minLength:3
            });
         });
    </script>
</html>
