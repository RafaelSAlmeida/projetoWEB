
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
                    <span id="nResultado"></span>
                </div>
            </div>
        </div>
        
        
        
    </body>
    <script type="text/javascript">
        $("#q").keyup(function(){
            
            alert($(this).val());
        });
    </script>
</html>
