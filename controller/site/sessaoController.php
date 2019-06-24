<?php

/*
 * 
 * RESPONSAVEL CONTROLLER PELA ENTRADA
 * 
 */

namespace controller\site;
use lib\Controller;
use app_controllerModel\sessao\ApiSessao;
use model\sessao\Sessao;
use model\usuario\Usuario;
use app_controllerModel\usuario\ApiUsuario;
use helper\Validador;
/**
 * Description of sessaoController
 *
 * @author ismael-if
 */
class sessaoController extends Controller{
   
    /**
     * o controller que vai chamar a tela de login 
     */
    public function login(){
        $this->title = 'Acesso Ao Login';
        $this->layout = '_layout.login';
        $this->view();
    }
    /**
     *  função que vai chamar o formulario pra cadastrar usuario apartir da pagina inicial
     */
    public function cadastrar_usuario() {
        $this->title = 'Acesso Restristo a usuario pra cadastro';
        $this->layout = '_layout.login';
        $this->view();
    }

    /**
     * 
     */
    public function logout(){
        $api = new ApiSessao();
        $api->logout();
        
    }
   

    /**
      *  A QUE É ONDE VAI RECEBER OS DADOS DO FORMULARIO QUE O USARIO VAI SE CADASTRAR A PARTIR DA PAGINA INICIAL
      */
     public function salvarCadastro(){
          $sec = new Validador();
         $usuario = new Usuario();
         $usuario->codgusario = $this->getParametro(0);
         $api = new ApiUsuario();

          if(isset($_FILES["foto"]["name"])){
          $arquivo =$_FILES["foto"]["name"];
          $path_dir = "fotos/". $arquivo;
          $vs= move_uploaded_file($_FILES["foto"]["tmp_name"], $path_dir);
        }
        $senha = $sec->criptografarUrl($_POST['senha']);
        $usuario->setNome($_POST['nome']);
        $usuario->setApelido($_POST['apelido']);
        $usuario->setNumeroEstudante($_POST['numeroEstudante']);
        $usuario->setTelefone($_POST['telefone']);
        $usuario->setEmail($_POST['email']);
        $usuario->setNivel($_POST['nivel']);
        $usuario->setSenha($senha);
        $usuario->setFoto(isset($arquivo)?$arquivo:'');
        
        
        $query = $api->salavarInsert( $usuario);
         //$this->dados = array('retrun' => $query);
    
        if($query['sucess']==TRUE):
            
             if($query['sucess'] > 0):
                 
             $this->validar();
             endif;
            
        endif;
        
      
     }
    /** 
     *  FUNÇÃO QUE VAI VALIDAR OS DADOS DO LOGIN , PRA USUARIO ACESSAR APLICAÇÃO 
     */
    public function validar() {

        $api = new ApiSessao();
        $query = $api->login(new Sessao('POST'));

        if ($query['sucess'] == TRUE):

            $this->perfil();

        else:
            

            $this->login();

        endif;
    }

}
