<?php
 include("../php/autoload.php");
    if(!empty($_POST)){
        $acao = $_POST['acao'];
        
       if($acao == 'busca_usuario'){
           $q = $_POST['q'];
           $usu = new Usuario();
           $usu->carregaUsuario("","concat(usu_nome,' ',usu_sobrenome) like '%{$q}%'");
           $rows = array();
            while($r = mysql_fetch_assoc($usu->conn->resultado)) {
              $rows['object_name'][] = $r;
            }

           echo json_encode($rows);
       }
      
    }
     if(!empty($_GET)){
        $acaoGET = $_GET['acao'];
        if($acaoGET=="buscainsumo"){
         $q = $_GET['term'];
         $usu = new Usuario();
         $usu->carregaUsuario("usu_login nome","concat(usu_nome,' ',usu_sobrenome) like '%{$q}%' OR usu_login like '%{$q}%'");
         
         $json = '[';
          $first = true;
          while($row = mysql_fetch_object($usu->conn->resultado))
          {
              if (!$first) { $json .=  ','; } else { $first = false; }
              $json .= '{"value":"'.utf8_encode($row->nome).'"}';
          }
          $json .= ']';
          echo $json;
          exit;
       }
     }
?>
