<?php
include("../php/Conexao.php");
class Usuario{
    
    /*
     * ID do usuario
     * @var integer id_usuario
     */
    public $id_usuario;
    
    /*
     * Nome do Usuário
     * @var String usu_nome
     */
    public $usu_nome;
    
    /*
     * Sobrenome do usuario
     * @var String usu_sobrenome
     */
    public $usu_sobrenome;
    
    /*
     * Login
     * @var String usu_login
     */
    public $usu_login;
    
    /*
     * Data de Nascimento
     * @var date usu_data_nascimento
     */
    public $usu_data_nascimento;
    
    /*
     * E-mail
     * @var String usu_email
     */
    public $usu_email;
    
    /*
     * Senha
     * @var String usu_senha
     */
    public $usu_senha;
    
    /*
     * Status de confirmação do e-mail
     * 0-Aguardando Confirmação 
     * 1-Confirmado
     * @var char(15) usu_status_email
     */
    public $usu_status_email;
        
    /*
     * Token utilizado para confirmação de e-mail e redefinição de senha
     * @var char(15) usu_token
     */
    public $usu_token;
    
    /*
     * Caminho para a foto do perfil
     * @var String usu_foto
     */
    public $usu_foto;
    
    /*
     * Descrição sobre o Usuario
     * @var String usu_descricao
     */
    public $usu_descricao;
        
    /*
     * Conexao
     * @var Mysql conn
     */
    public $conn;
    
    function __construct($conn = NULL) {
        if($conn==NULL){
            $this->conn=new Conexao();
            
        }else{
            $this->conn = $conn;
        }
        
        return $this->conn;    
            
    }
    
    function insereUsuario(){
        $sql = "INSERT INTO usuario(usu_nome, usu_sobrenome, usu_login, usu_data_nascimento, usu_email, usu_senha) VALUES
                            ('{$this->usu_nome}','{$this->usu_sobrenome}','{$this->usu_login}','{$this->usu_data_nascimento}','{$this->usu_email}','{$this->usu_senha}')";
        $this->conn->execute_query($sql);
        
    }
    
    function carregaUsuario($PARAM='',$WHERE='',$ORDERBY='',$GROUPBY=''){
        $WHERE = ($WHERE!='')?'WHERE '.$WHERE:'';
        $ORDERBY = ($ORDERBY!='')?'ORDER BY '.$ORDERBY:'';
        $GROUPBY = ($GROUPBY!='')?'GROUP BY '.$GROUPBY:'';
        $PARAM = ($PARAM!='')?$PARAM:'*';
        $sql = "SELECT {$PARAM} FROM usuario {$WHERE} {$GROUPBY} {$ORDERBY}";
        $this->conn->execute_query($sql);
        
          
        
    }
    
}


?>
