
<?php
include("../php/Conexao.php");
if(!empty($_POST)){
    $con = new Conexao();
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    /*$email = $_POST['email'];
    if($email){

        $sql = "";
    }else{
        $sql = "";
    }*/

    $sql = "SELECT * FROM usuario WHERE usu_login='$login' ";

    $con->execute_query($sql);
    //echo mysql_num_rows($con->resultado);
    if($con->resultado > 0){
        if(md5($senha) == $con->resultado->usu_senha){
            echo "sucesso";
        }
        else
            echo "erro";
    } else
        echo "erro";
    exit;
}
else{
    header('location:../index.php');   
}
/*
 * if
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
