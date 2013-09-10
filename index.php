<!DOCTYPE html>
<?php
include('php/autoload.php');
include('php/utilitarios.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <title>Página Inicial</title>
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
                <div id="direita" >
                    <div id="login"  class="div_transparente">
                        <h2>Login</h2>
                        
                        <input type="text" id="usr" name="usr" placeholder="Usuário ou E-mail" style="width:235px"/>
                        <br/>
                        <input type="password" id="pass" name="pass" placeholder="Senha" style="width:235px"/><br/>
                        <label id="aviso"></label>
                        <br/>
                        <input type="checkbox" id="lembrar"/> <label for="lembrar">Continuar conectado</label><br/>
                        <a href="#" id="esqueceu">Esqueceu sua senha?</a>
                        <br/>
                        <input type="button" class="button" id="entrar" name="entrar" value="ENTRAR" />
                    </div>
                    <div id="join"  class="div_transparente">
                        <h2>Crie sua Conta</h2>
                       <form action="" id="formCadastro" method="POST"> 
                        <input type="text" id="nome" name="nome" placeholder="Nome" required="true" style="width:235px"/>
                        <label id="nomeValidate"></label>
                        <br/>
                        <input type="text" id="email" name="email" placeholder="E-mail" required="true" style="width:235px;float:left;"/>
                        <span id="emailValidate" class="none" style ="width:16px;float:left;margin-top: 8px;"></span>
                        <br/>
                        <input type="text" id="senha" name="senha" placeholder="Senha" maxlength="10" required="true" style="width:235px"/>
                        <label id="senhaValidate"></label>
                        <br/>
                        <br/>
                        <input type="button" class="button" id="cadastrar" name="cadastrar" value="Cadastrar" required="true" />
                       </fom>
                   </div>
                </div>
                </div>
            </div>
        </div>
        
        
        
    </body>
    <script type="text/javascript">
        $.ajax({url: "ajax/validar.php",
                            data: {
                                   acao:"validarCookie"},
                            type:"POST",
                            async:false,
                            success:function(data){
                                if(data=="sucesso"){
                                    window.location = 'perfil.php?u=';
                                }else if(data=="erro"){
                                    aviso("Erro","Login ou senha Inválidos!",'ui-icon-alert');
                                }
                            }});
        function IsEmail(email){
            var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
            var check=/@[\w\-]+\./;
            var checkend=/\.[a-zA-Z]{2,3}$/;
            if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}
            else {return true;}
        }

        $(document).ready(function(){
           $(".button").button();
            
            $("#q").autocomplete({
                source:"ajax/busca.php?acao=busca_topo",
                minLength:3
            });
            $("#entrar").click(function(){
                var login = $("#usr").val();
                var email = login.indexOf('@');
                if(email > 0 )
                    var flag = true;
                else {
                    var flag = false;
                }
                var check = document.getElementById("lembrar").checked;
               $.ajax({url: "ajax/validar.php",
                            data: {login:login,
                                   senha:$("#pass").val(),
                                   flag:flag,
                                   check:check,
                                   acao:"validarLogin"},
                            type:"POST",
                            async:false,
                            success:function(data){
                                if(data=="sucesso"){
                                    aviso("Login","BEM VINDO",'ui-icon-key');
                                    var url = 'perfil.php?u='+login;
                                    location.href=url;
                                    //window.location = 'perfil.php?u=';
                                }else if(data=="erro"){
                                    aviso("Erro","Login ou senha Inválidos!",'ui-icon-alert');
                                }
                            }}); 
            });   
            $("#email").blur(function(){
                
                $("#emailValidate").removeClass("ui-icon ui-icon-check");
                $("#emailValidate").removeClass("ui-icon ui-icon-close");
                if($(this).val()!=''){
                 
                    if(IsEmail($(this).val())){
                    $.ajax({url: "ajax/validar.php",
                            data: {email:$(this).val(),
                                   acao:"validarEmail"},
                            type:"POST",
                            async:false,
                            success:function(data){
                                if(data=='0'){
                                    $("#emailValidate").removeClass("none");
                                    $("#emailValidate").removeClass("ui-icon ui-icon-close");
                                    $("#emailValidate").addClass("ui-icon ui-icon-check");
                                }
                                else{
                                    $("#email").focus();
                                    $("#emailValidate").removeClass("none");
                                    $("#emailValidate").removeClass("ui-icon ui-icon-check");
                                    $("#emailValidate").addClass("ui-icon ui-icon-close");
                                }
                            }});
                    }else{
                        $("#email").focus();
                        $("#emailValidate").removeClass("ui-icon ui-icon-check");
                        $("#emailValidate").addClass("ui-icon ui-icon-close");
                    }       

            }
            });
                        
            $("#senha").focus(function(){
                if($(this).val()=="")
                {   
                    $(this).attr("type","password");
                }
            });
            
            $("#esqueceu").click(function(){
                
                aviso("Aviso","Sua senha sera enviada para o e-mail cadastrado!<input type='text'/>",'ui-icon-notice');
            });
            
            //BUTTON CADASTRAR
            $("#cadastrar").click(function(){
                if(IsEmail($("#email").val())){
                    if($("#senha").attr("type")==="password"){
                        
                        $("#formCadastro").attr("action","cadastro_usuario.php");
                        $("#formCadastro").submit();
                        
                    }else {
                        $("#senha").focus();
                    }

                }else{
                    $("#email").focus();
                    $("#emailValidate").text('ERRO');
                } 
            });
            //BUTTON CADASTRAR
            
        });
        
        
    </script>
</html>
