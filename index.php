
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
        <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.9.2.custom.css" />
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
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
                        
                        <input type="text" id="usr" name="usr" placeholder="Usuário ou E-mail"/>
                        <br/>
                        <input type="password" id="pass" name="pass" placeholder="Senha"/><br/>
                        <label id="aviso"></label>
                        <p><input type="checkbox" id="lembrar" />Lembrar Dados?</p>
                        <a>Esqueceu sua senha?</a>
                        <br/>
                        <input type="button" class="button" id="entrar" name="entrar" value="ENTRAR" />
                    </fieldset>
                    <fieldset id="join">
                        <legend>Crie sua Conta</legend>
                       <form action="" id="formCadastro" method="POST"> 
                        <input type="text" id="nome" name="nome" placeholder="Nome" required="true"/>
                        <label id="nomeValidate"></label>
                        <br/>
                        <input type="text" id="email" name="email" placeholder="E-mail" required="true"/>
                        <label id="emailValidate"></label>
                        <br/>
                        <input type="text" id="senha" name="senha" placeholder="Senha" maxlength="10" required="true"/>
                        <label id="senhaValidate"></label>
                        <br/>
                        <input type="button" class="button" id="cadastrar" name="cadastrar" value="Cadastrar" required="true" />
                       </fom>
                   </fieldset>
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
                                    alert("Login ou senha Inválido");
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
                                    alert("BEM-VINDO");
                                    window.location = 'perfil.php?u=';
                                }else if(data=="erro"){
                                    alert("Login ou senha Inválido");
                                }
                            }}); 
            });   
            $("#email").blur(function(){
                if($(this).val()!=''){
                 
                    if(IsEmail($(this).val())){
                    $.ajax({url: "ajax/validar.php",
                            data: {email:$(this).val(),
                                   acao:"validarEmail"},
                            type:"POST",
                            async:false,
                            success:function(data){
                                if(data=='0')
                                    $("#emailValidate").text('OK');
                                else{
                                    $("#email").focus();
                                    $("#emailValidate").text('ERRO');
                                }
                            }});
                    }else{
                        $("#email").focus();
                        $("#emailValidate").text('ERRO');
                    }       

            }
            });
                        
            $("#senha").focus(function(){
                if($(this).val()=="")
                {   
                    $(this).attr("type","password");
                }
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
