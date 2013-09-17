<?php
class Conexao {

    private $host = "localhost"; 
    private $user = "root"; 
    private $senha = ""; 
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
            print "Ocorreu um Erro na conexão!";
            die();
       }elseif(!mysql_select_db($this->dbase,$this->conn)){
            print "Ocorreu um Erro em selecionar a Base!";
            die();
        }
    }

    function execute_query($query){
        
        $this->conecta();
        $this->query = $query;
        if($this->resultado = mysql_query($this->query)){
            $this->desconecta();
        }else{
            print "Erro de consulta!";
            die();
            $this->desconecta();
        }        
    }

    function desconecta(){
        return mysql_close($this->conn);
    }
}
?>
