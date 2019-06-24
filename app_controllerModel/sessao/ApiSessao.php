<?php

namespace app_controllerModel\sessao;
use lib\Model;
use model\sessao\Sessao;
use helper\Validador;



/**
 * Description of apiSessao
 *
 * @author ismael-if
 */
class ApiSessao extends Model{
    
    
    public function login(Sessao $obj){
        $he = new Validador();
      
      $user = trim($obj->email);
      $pass = trim($obj->senha);
      
      $sql = "SELECT * FROM usuario WHERE email = '{$user}'" ; 
      $query= $this->First($this->Listar($sql));
      
      
      if(isset($query->senha)){
          
          if($he->criptografarUrl($pass) == $query->senha){
            
              $this->criaSessao($query);
            // $_SESSION['usuario'] =$query->senha;
              return array('sucess' =>true, 'feedback' =>'logado com suceso ');
               
              
          }
            else {
                  define('ERRO_LGOIN','<br> NAO FOI POSSIVEL FAZER O LOGIN VERFICA OS DADOS ');
                 header("Location:" .APP_LOGIN.'login');
              }
           }
      else {
                  define('ERRO_LGOIN_SENHA','<br> NAO FOI POSSIVEL FAZER O LOGIN SENHA SERRADA');
                 header("Location:" .APP_LOGIN.'login');
        }
        
    }
    
    /**
     * 
     */
    public function criaSessao($dados){
        $securty =  new Validador();
        
       if (((!isset($_SESSION['unia'])) && (!isset($_SESSION['usuario'])))):
            session_destroy();
            session_start();
            $httponly = true;
            
            $_SESSION['unia'] = $dados;
            $_SESSION['usuario']=  $securty->criptografarUrl('usuario'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
            session_regenerate_id(TRUE);
            setcookie( session_name(), session_id(), null, '/', null, null, $httponly );
            
          
        endif; 
    }
    
       
    public function logout(){
       $_SESSION['sair'] = $_SESSION['unia'];
        unset($_SESSION['unia']);
        unset($_SESSION['usuario']);
        header("Location:" .APP_LOGIN.'login');

        
        
    }
    
    
    
}
