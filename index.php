
<?php
include('php/autoload.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <title>Página Inicial</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        
        <link rel="stylesheet" type="text/css" href="css/geral.css" />
    </head>
    <body>
        <div id="geral">
            <div id="topo">
            </div>
            <div id="conteudo">
                <div class="wrap">
                <div id="esquerda">
                    <h1>Bem vindo</h1>
                    <p>Uma pequena descrição sobre o trabalho....
                        Uma pequena descrição sobre o trabalho....
                        Uma pequena descrição sobre o trabalho....
                        Uma pequena descrição sobre o trabalho....
                        Uma pequena descrição sobre o trabalho....
                        Uma pequena descrição sobre o trabalho....
                    </p>
                </div>
                <div id="direita">
                    <fieldset id="login">
                        <legend>Login</legend>
                        
                        <input type="text" id="usr" name="usr" value="Usuário ou E-mail"/>
                        <br/>
                        <input type="text" id="pass" name="pass" value="Senha"/><br/>
                        <label id="aviso"></label>
                        <br/>
                        <input type="checkbox" id="lembrar"/>Lembrar Dados?
                        <a>Esqueceu sua senha?</a>
                        <br/>
                        <input type="button" id="entrar" name="entrar" value="ENTRAR" />
                    </fieldset>
                    <fieldset id="join">
                        <legend>Crie sua Conta</legend>
                        
                        <input type="text" id="nome" name="nome" value="Nome"/>
                        <label id="nomeValidate"></label>
                        <br/>
                        <input type="text" id="email" name="email" value="E-mail"/>
                        <label id="emailValidate"></label>
                        <br/>
                        <input type="text" id="pass" name="pass" value="Senha"/>
                        <label id="senhaValidate"></label>
                        <br/>
                        <input type="button" id="cadastrar" name="cadastrar" value="Cadastrar" />
                    </fieldset>
                </div>
                </div>
            </div>
        </div>
        
        
        
    </body>
    <script type="text/javascript">
        $(document).ready(function(){
            //alert("entrou");
            //busca o @ no campo login se sim é e-mail senao
            var login = $("#usr");
            var email = login.indexOf('@');
            if(email > 0 )
                flag=true;
            else {
                flag =false;
            }
            $("#entrar").click(function(){
               $.post("ajax/validarLogin.php",
                       {login:login,senha:senha, email:flag},
                       function(data){
                           if(data=='sucesso'){
                               $(window.document.location).attr('href',perfil.php);
                           }else if(data=='erro'){
                               $("#aviso").text('Usuario ou senha Invalidos');
}

                           
                       }),true 
            });
        });
    </script>
</html>
