<?php
class Conexao {

    private $host = "localhost"; 
    private $user = "root"; 
    private $senha = "root"; 
    private $dbase = "projeto_web"; 

    public $query;
    public $conn;
    public $resultado;
    
    function Conexao($conn=NULL){
        if($conn!=NULL){
            $this->conecta();          
        }else{
            $this->conn = $conn;
        }
        
        return $this->conn;    
    }

    function MySQL(){
    
    }
   
    function conecta(){
       $this->conn = @mysql_connect($this->host,$this->user,$this->senha);
    
       if(!$this->conn){
            print "Ocorreu um Erro na conexão MySQL:";
            print "<b>".mysql_error()."</b>";
            die();
       }elseif(!mysql_select_db($this->dbase,$this->conn)){
            print "Ocorreu um Erro em selecionar o Banco:";
            print "<b>".mysql_error()."</b>";
            die();
        }
    }

    function query($query){
        $this->conecta();
        $this->query = $query;
        if($this->resultado = mysql_query($this->query)){
            $this->desconecta();
        }else{
            print "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
            print "<br><br>";
            print "Erro no MySQL: <b>".mysql_error()."</b>";
            die();
            $this->desconecta();
        }        
    }

    function desconecta(){
        return mysql_close($this->conn);
    }
}
?>
