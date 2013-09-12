<?php

class Publicacao{
    
    /*
     * ID da publicacao
     * @var integer id_publicacao
     */
    public $id_publicacao;
    
    /*
     * ID do usuario
     * @var integer usuario_id
     */
    public $usuario_id;
    
    /*
     * Data da Publicação
     * YYYY-mm-dd hh:mm:ss
     * @var date pub_data
     */
    public $pub_data;
    
    /*
     * Mensagem da publicação
     * @var String pub_mensagem
     */
    public $pub_mensagem;
    
    /*
     * URL da mídia
     * @var $pub_url pub_url
     */
    public $pub_url;
    
    /*
     * Tipo da Mídia
     * 0 - imagem
     * 1 - video 
     * 2 - audio
     * @var integer id_usuario
     */
    public $pub_tipo_midia;
    
    /*
     * Nº de Acessos
     * @var integer pub_n_acesso
     */
    public $pub_n_acesso;
    
    /*
     * Autor da Mídia
     * @var String pub_autor
     */
    public $pub_autor;
    
    /*
     * Titulo da mídia
     * @var String pub_titulo
     */
    public $pub_titulo;
    
        
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
        
        define("IMAGEM","0");
        define("VIDEO","1");
        define("AUDIO","2");
        return $this->conn;    
            
    }
    
    function inserePublicacao(){
        $sql = "INSERT INTO publicacao(usuario_id, pub_data, pub_mensagem, pub_url, pub_tipo_midia, pub_n_acesso, pub_autor, pub_titulo) VALUES
                            ({$this->usuario_id},'{$this->pub_data}','{$this->pub_mensagem}','{$this->pub_url}',{$this->pub_tipo_midia},{$this->pub_n_acesso},'{$this->pub_autor}','{$this->pub_titulo}')";
        $this->conn->execute_query($sql);
        
    }
    
    function carregaPublicacao($PARAM='',$WHERE='',$ORDERBY='',$GROUPBY=''){
        $WHERE = ($WHERE!='')?'WHERE '.$WHERE:'';
        $ORDERBY = ($ORDERBY!='')?'ORDER BY '.$ORDERBY:'';
        $GROUPBY = ($GROUPBY!='')?'GROUP BY '.$GROUPBY:'';
        $PARAM = ($PARAM!='')?$PARAM:'*';
        $sql = "SELECT {$PARAM} FROM publicacao {$WHERE} {$GROUPBY} {$ORDERBY}";
        $this->conn->execute_query($sql);
          
        
    }
    
    function incrementar(){
        
    }
}


?>
