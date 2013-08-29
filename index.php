
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
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
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
                       <form action="" id="formCadastro" method="POST"> 
                        <input type="text" id="nome" name="nome" value="Nome" required="true"/>
                        <label id="nomeValidate"></label>
                        <br/>
                        <input type="text" id="email" name="email" value="E-mail" required="true"/>
                        <label id="emailValidate"></label>
                        <br/>
                        <input type="text" id="senha" name="senha" value="Senha" maxlength="10" required="true"/>
                        <label id="senhaValidate"></label>
                        <br/>
                        <input type="button" id="cadastrar" name="cadastrar" value="Cadastrar" required="true" />
                       </fom>
                   </fieldset>
                </div>
                </div>
            </div>
        </div>
        
        
        
    </body>
    <script type="text/javascript">
        
        function IsEmail(email){
            var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
            var check=/@[\w\-]+\./;
            var checkend=/\.[a-zA-Z]{2,3}$/;
            if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}
            else {return true;}
        }

        $(document).ready(function(){
            //alert("entrou");
            //busca o @ no campo login se sim é e-mail senao
            
            $("#entrar").click(function(){
                var login = $("#usr").val();
                var email = login.indexOf('@');
                if(email > 0 )
                    flag=true;
                else {
                    flag =false;
                }
               $.ajax({url: "ajax/validar.php",
                            data: {login:login,
                                   senha:$("#pass").val(),
                                   acao:"validarLogin"},
                            type:"POST",
                            async:false,
                            success:function(data){
                                if(data=="sucesso"){
                                    alert("BEM-VINDO");
                                    window.location = 'perfil.php?u=';
                                }else{
                                    alert("ERRO");
                                }
                            }}); 
            });
            $("#nome").focus(function(){
                if($(this).val()=="Nome")
                    $(this).val('');
            });
            
            $("#nome").blur(function(){
                if($(this).val()=='')
                {
                    $(this).val('Nome');
                }
            });
            
            $("#usr").focus(function(){
                if($(this).val()=="Usuário ou E-mail")
                    $(this).val('');
            });
            
            $("#usr").blur(function(){
                if($(this).val()=='')
                {
                    $(this).val('Usuário ou E-mail');
                }
            });
            
            
            $("#pass").focus(function(){
                if($(this).val()=="Senha")
                    $(this).val('');
            });
            
            $("#pass").blur(function(){
                if($(this).val()=='')
                {
                    $(this).val('Senha');
                }
            });
            
            $("#email").focus(function(){
                if($(this).val()=="E-mail")
                    $(this).val('');
            });
            
            $("#email").blur(function(){
                if($(this).val()==''){
                    $(this).val('E-mail');
                    $("#emailValidate").text('');
                }
                else{
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
                                    $("#email").val("E-mail");
                                    $("#email").focus();
                                    $("#emailValidate").text('ERRO');
                                }
                            }});
                    }else{
                        $("#email").val("E-mail");
                        $("#email").focus();
                        $("#emailValidate").text('ERRO');
                    }       

            }
            });
                        
            $("#senha").focus(function(){
                if($(this).val()=="Senha")
                {   
                    $(this).attr("type","password");
                    $(this).val('');
                }
            });
            
            $("#senha").blur(function(){
                if($(this).val()=='')
                {
                    $(this).attr("type","text");
                    $(this).val('Senha');
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
                    $("#email").val("E-mail");
                    $("#email").focus();
                    $("#emailValidate").text('ERRO');
                } 
            });
            //BUTTON CADASTRAR
            
        });
        
        
    </script>
</html>
