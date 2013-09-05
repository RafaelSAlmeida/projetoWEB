<?php
 include("../php/Conexao.php");
    
    if(!empty($_POST)){
        $acao = $_POST['acao'];
        $acaoGET = $_GET['acaoGET'];
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
       if($acao == 'busca_topo'){
           $q = $_GET['term'];
           $con = new Conexao();
           $sql = "SELECT concat(usu_nome,' ',usu_sobrenome) nome 
                    FROM USUARIO
                    WHERE concat(usu_nome,' ',usu_sobrenome) like '%{$q}%'";
           $con->execute_query($sql);
           $json = '[';
            $first = true;
            while($row = mysql_fetch_object($con->resultado))
            {
                if (!$first) { $json .=  ','; } else { $first = false; }
                $json .= '"'.utf8_encode($row->nome).'"';
            }
            $json .= ']';
            echo $json;
       }
    }
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
