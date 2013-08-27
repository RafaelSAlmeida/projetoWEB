
<?php
include("../php/Conexao.php");
$con = new Conexao();
$email = $_POST['email'];
if($email){
    
    $sql = "";
}else{
    $sql = "";
}


$con->execute_query($sql);
echo mysql_num_rows($con->resultado);
if(1){
    
    echo "sucesso";
} else
    echo "erro";
exit;
/*
 * if
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
