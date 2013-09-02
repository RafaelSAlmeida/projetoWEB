<?php
 include("../php/Conexao.php");
    
    if(!empty($_POST)){
        $acao = $_POST['acao'];
       if($acao == 'busca_usuario'){
           $q = $_POST['q'];
           $con = new Conexao();
           $sql = "SELECT * 
                    FROM USUARIO
                    WHERE concat(usu_nome,' ',usu_sobrenome) like '%{$q}%'";
           $con->execute_query($sql);
           $rows = array();
            while($r = mysql_fetch_assoc($con->resultado)) {
              $rows['object_name'][] = $r;
            }

           echo json_encode($rows);
       }
    }
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
