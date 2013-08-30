
<?php
include('php/autoload.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!empty($_POST))
{
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
}
?>
<html>
    <head>
        <title>Cadastro de Usuário</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        
        <link rel="stylesheet" type="text/css" href="css/geral.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.9.2.custom.css" />
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
    </head>
    <body>
        <div id="geral">
            <div id="topo">
                <?php include('php/buscar.php');?>
            </div>
            <div id="conteudo">
                <div class="wrap">
                    <h1>SOU NOVO AQUI</h1>
                    <form action="" method="POST" id="formUsuario">
                        <input type="hidden" id="acao" name="acao" value="inserir_usuario"/>
                        <input type="text" id="nome" name="nome" <?php if($nome) echo 'value="'.$nome.'"'; else echo 'placeholder="Nome"';?>" />
                        <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome" /><br/>
                        <input type="text" id="usuario" name="usuario" placeholder="Escolha seu usuário" />
                        <label id="usuarioValidate"></label><br/><br/>
                        <label>Data de Nascimento:</label><br/>
                        <select id="dia" name="dia" >
                            <option value="">DIA</option>
                        </select>
                        
                        <select id="mes" name="mes">
                            <option value="">MÊS</option>
                            <option value="1">JAN</option>
                            <option value="2">FEV</option>
                            <option value="3">MAR</option>
                            <option value="4">ABR</option>
                            <option value="5">MAI</option>
                            <option value="6">JUN</option>
                            <option value="7">JUL</option>
                            <option value="8">AGO</option>
                            <option value="9">SET</option>
                            <option value="10">OUT</option>
                            <option value="11">NOV</option>
                            <option value="12q">DEZ</option>
                        </select>
                        
                        <select id="ano" name="ano">
                            <option value="">ANO</option>
                        </select>
                        <br/><br/>
                        <input type="text" id="email" name="email" <?php if($email) echo 'value="'.$email.'"'; else echo 'placeholder="E-mail"';?> />
                        <label id="emailValidate"></label><br/>
                        <input type="text" id="confEmail" name="confEmail" placeholder="Confirmação de E-mail" />
                        <label id="confEmailValidate"></label><br/><br/>
                        <input type="<?php if($senha) echo "password"; else echo "text";?>" id="senha" name="senha" <?php if($senha) echo 'value="'.$senha.'"'; else echo 'placeholder="Senha"';?>" /><br/>
                        <input type="text" id="confSenha" name="confSenha" placeholder="Confirmação de Senha" />
                        <label id="confSenhaValidate"></label><br/><br/>
                        <input type="button" class="button" id="cadastrar" name="cadastrar" value="Criar Conta" /><br/>
                    </form>
                </div>
            </div>
        </div>
        
        
        
    </body>
    <script type="text/javascript">
        function validar(){
            var campos_erro = '';
            var nome = $("#nome").val();
            var sobrenome = $("#sobrenome").val();
            var usuario = $("#usuario").val();
            var dia = $("#dia").val();
            var mes = $("#mes").val();
            var ano = $("#ano").val();
            var email = $("#email").val();
            var confemail = $("#confEmail").val();
            var senha = $("#senha").val();
            var confsenha = $("#confSenha").val();
            
            if(nome=='Nome' || nome==''){
                campos_erro += ((campos_erro=='')?'':',')+"#nome";
            }
            
            if(sobrenome=='Sobrenome' || sobrenome==''){
                campos_erro += ((campos_erro=='')?'':',')+"#sobrenome";
            }
                        
            if(usuario=='Escolha seu usuário' || usuario==''){
                campos_erro += ((campos_erro=='')?'':',')+"#usuario";
            }
            
            if(dia==''){
                campos_erro += ((campos_erro=='')?'':',')+"#dia";
            }
            
            if(mes==''){
                campos_erro += ((campos_erro=='')?'':',')+"#mes";
            }
            
            if(ano==''){
                campos_erro += ((campos_erro=='')?'':',')+"#ano";
            }
            
            if(email=='E-mail' || email==''){
                campos_erro += ((campos_erro=='')?'':',')+"#email";
            }
            
            if(confemail=='Confirmação de E-mail' || confemail==''){
                campos_erro += ((campos_erro=='')?'':',')+"#confEmail";
            }
            
            if(senha=='Senha' || senha==''){
                campos_erro += ((campos_erro=='')?'':',')+"#senha";
            }
            
            if(confsenha=='Confirmação de Senha' || confsenha==''){
                campos_erro += ((campos_erro=='')?'':',')+"#confSenha";
            }
            
            $(campos_erro).attr("class","erro");
            if(campos_erro==="")
                return true;
        }
        function IsEmail(email){
            var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
            var check=/@[\w\-]+\./;
            var checkend=/\.[a-zA-Z]{2,3}$/;
            if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}
            else {return true;}
        }
        
        function confirmaEmail(email,confEmail){
            if(email===confEmail)
                return true;
            else
                return false;

        }
        
        function confirmaSenha(senha,confSenha){
            if(senha===confSenha)
                return true;
            else
                return false;

        }
        $(document).ready(function(){
            $(".button").button();
            for(var i=1;i<=31;i++)
            {
                $("#dia").append("<option value="+i+">"+i+"</option>");
            }
            var d = new Date();

            for(var i=d.getFullYear();i>=1905;i--)
            {
                $("#ano").append("<option value="+i+">"+i+"</option>");
            }
            
            
            $("#email").blur(function(){
                if($(this).val()!=''){
                    if(IsEmail($(this).val())){
                    $.ajax({url: "ajax/validar.php",
                            data: {email:$(this).val(),
                                   acao:"validarEmail"},
                            type:"POST",
                            async:false,
                            success:function(data){
                                if(data==='0')
                                    $("#emailValidate").text('OK');
                                else{
                                    $("#email").val("E-mail");
                                    $("#email").focus();
                                    $("#emailValidate").text('ERRO');
                                }
                            }});
                        
                        $(this).removeAttr("class");
                    }else{
                        $("#email").val("E-mail");
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
            
            $("#senha").blur(function(){
                if($(this).val()=='')
                {
                    $(this).removeAttr("class");
                }
            });
            
                        
            $("#confSenha").focus(function(){
                if($(this).val()=="Confirmação de Senha")
                {   
                    $(this).attr("type","password");
                    $(this).val('');
                }
            });
            
            $("#confSenha").blur(function(){
                if($(this).val()=='')
                {
                    $(this).attr("type","text");
                    $(this).val('Confirmação de Senha');
                }else{
                    if(!confirmaSenha($("#senha").val(),$("#confSenha").val())){
                        
                        $("#confSenhaValidate").text('ERRO');
                        $("#confSenha").focus();
                        $("#confSenha").val('');
                    }else{
                        $(this).removeAttr("class");                        
                        $("#confSenhaValidate").text('');
                    }
                }
            });
            
            
            
            $("#confEmail").blur(function(){
                
                    if(!confirmaEmail($("#email").val(),$("#confEmail").val()))
                    {
                        $("#confEmailValidate").text('ERRO');
                        $("#confEmail").focus();
                        $("#confEmail").val('');
                    }else{
                        $(this).removeAttr("class");
                        $("#confEmailValidate").text('');
                    }
                
            });
                        
            
            $("#usuario").blur(function(){
                if($(this).val()!='')
                {
                    $.ajax({url: "ajax/validar.php",
                            data: {login:$(this).val(),
                                   acao:"validarUsuario"},
                            type:"POST",
                            async:false,
                            success:function(data){
                                if(data==='0'){
                                    
                                    $("#usuarioValidate").text('OK');
                                     $("#usuario").removeAttr("class");                    
                                }
                                else{
                                   $("#usuario").focus();
                                    $("#usuarioValidate").text('ERRO');
                                }
                            }});      

                }
            });
            $("#dia").blur(function(){
                if($(this).val()!=""){
                    $(this).removeAttr("class");
                }
            });
            $("#mes").blur(function(){
                if($(this).val()!=""){
                    $(this).removeAttr("class");
                }
            });
            $("#ano").blur(function(){
                if($(this).val()!=""){
                    $(this).removeAttr("class");
                }
            });
            $("#cadastrar").click(function(){
                if(validar())
                {
                    $.ajax({url: "ajax/inserir.php",
                        data: $("#formUsuario").serialize(),
                        type:"POST",
                        async:false,
                        success:function(data){
                            if(data==='1')
                            {
                                alert("Cadastro Realizado com Sucesso");
                                window.location = 'perfil.php?u=';
                            }
                            else{
                                alert("Erro durante o cadastro!");
                            }
                        }});
                  }else{
                      alert("Preencha os campos em destaque!");
                  }
            });
            
        });
    </script>
</html>
