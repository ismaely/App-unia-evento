<?php
namespace controller\admin;

use app_controllerModel\usuario\ApiUsuario;
use app_controllerModel\comentario\ApiComentario;
use model\comentario\Comentario;
use lib\Controller;
use model\usuario\Usuario;
use model\usuario\Estado_pessoal;
use helper\Seguranca;
use helper\Validador;

/**
 * função que vai salvar dados do admin que o formulario vai mandar  
 *
 * @author ismael-if
 */
class usuarioController extends Controller{
   
    public function __construct() {
        parent::__construct();
        
        new Seguranca();
        $this->title=" UNIA-Usuario";
       }

    /**
     * 
     */
    function cadastrar_usuario(){
       
         $this->layout='_layout.perfilUsuario';
        if($this->getParametro(0) > 0 ){
            
           $usuario = new Usuario();
           $api = new ApiUsuario(); 
          $usuario->codgusario = $this->getParametro(0);
          $this->dados = array(
            'dados' => $api->getListar($usuario));  
          
               }
        $this->view(); 
        
    }
    /**
     * funcção responsavel por buscar os dados do formulario sobre me e mostra os dados dentro do formulario pra ser editado
     */
   function sobre_me(){
        $this->layout='_layout.perfilUsuario'; 
          $api = new ApiUsuario();
          $usuario = new Estado_pessoal();
          $usuario->codgusuario= $_SESSION['unia']->codgusario;
          
           $this->dados=array(
            'dados' => $api->Listar_detalhe_usuario($usuario) );
        
          $this->view();
        
        
        
     }
     
     /**
      * salvar os dados que vao ser enviado do formulario saobre ou actualizar me 
      */
     function sobreMeSalvar() {
       
        $usuario = new Estado_pessoal();
        $api = new ApiUsuario();
        $usuario->codgusuario = $_SESSION['unia']->codgusario;
        $this->dados = $api->Listar_detalhe_usuario($usuario);
        if (empty($this->dados->codgusuario) && $this->dados->codgusuario == NULL) {
            
              $this->dados = array('dados'=>$api->Insert_sobreMe(new Estado_pessoal ('POST')) );
             header("Location:" .APP_ADMIN.'usuario/detalhe_usuario');
        } else {
            $this->dados = array('dados'=>$api->Actualizar_sobreMe(new Estado_pessoal ('POST')) );
          header("Location:" .APP_ADMIN.'usuario/detalhe_usuario');
        }
        
    }

    /**
     * 
     */
    
     function comentario_sugestao(){
         $this->layout='_layout.perfilUsuario'; 
         if(!empty($_POST)):
             
               $api = new ApiComentario();
               $this->dados = array(
               'listComentario' => $api->Insert_comentrio(new Comentario('POST'))
                );
           endif; 
                
                $ap = new ApiComentario();
                $this->dados = array(
               'listComentario' => $ap->getList()
                   );  
                  
              $this->view();     
        
        
    }
    /**
     * 
     */
    function actualizar_dados() {
       
        $this->view();
    }

    /**
     * FUNÇÃO QUE VAI ALTERAR A SENHA
     */
    function alterar_senha() {
        $this->layout = '_layout.perfilUsuario';
        if (!empty($_POST)):
            $api = new ApiUsuario();
            $post = new Usuario('POST');
             $sec = new Validador();

            $this->dados = array(
                'alterar' => $api->ActualizarSenha($sec->criptografarUrl($post->senha))
            );
        endif;
        $this->view();
    }

    /**
     * CONTROLLER QUE VAI TRAZER OS DADOS SELECIONADO DAS DUAS TABELAS USARIO E ESTADO_PESSOAL
     */
    function informacao() {
        $this->layout = '_layout.perfilUsuario';
        $usuario = new Usuario();
        $api = new ApiUsuario();
        $usuario->codgusario = $this->getParametro(0);

        $this->dados = array(
            'dados' => $api->Listar_informacao_cliente($usuario)
        );
        $this->view();
    }
    
    /**
    function auxiliar_inormacao($id){
        $usuario = new Usuario();
        $api = new ApiUsuario();
        $usuario->codgusario = $this->getParametro($id);

        $this->dados = array(
            'dados' => $api->Listar_detalhe_usuario($usuario)
        );
        
        return $this->dados;
    } */

    /**
 *  controller que vai caregar os dados do perfil quando decidir ver a sua  informaçoã pessoal
 */
  function detalhe_usuario(){
        
         $this->layout='_layout.perfilUsuario';
          $api = new ApiUsuario();
          $usuario = new Estado_pessoal();
          $usuario->codgusuario= $_SESSION['unia']->codgusario;
          
           $this->dados=array(
            'dados' => $api->Listar_detalhe_usuario($usuario) );
        
          $this->view();
        
    }

        /**
     *  CONTROLLER PRA MOSTAR OS DADOS DA CONSULTA QUANDO O ADMIN SOLICITAR
     */
   function consultar_usuario(){
         $this->layout='_layout.perfilUsuario';
        
         if(!empty($_POST)):
             
               $api = new ApiUsuario();
               $this->dados = array(
               'listBusca' => $api->consultas(new Usuario('POST'))
                );
               
                $this->view();  
              else :
                  
                $this->view();     
         endif;
         
    }
    
    
    /**
     * função que busca o usario que vai ser eliminado , e que depois recebe os dados pra eliminar 
     */
    function elimina_buscaUsario() {

        $this->layout = '_layout.perfilUsuario';

        $Usuario = new Usuario();
        $Usuario->codgusario = $this->getParametro(0);
        $api = new ApiUsuario();

        if (!empty($_POST) && isset($_POST['numeroEstudante'])) {

            $this->dados = array(
                'list' => $api->consultas(new Usuario('POST'))
            );
            $this->view();
        } elseif ($Usuario->codgusario > 0) {

            $query = $api->Deletar($Usuario);
            $this->dados = array('aviso' => $query);

            $this->view('elimina_buscaUsario');
        } else {

            $this->view();
        }
    }

    /**
    *  aque é onde vai receber os dados pra ser eliminado o usario
    */ 
   function eliminar_usuario() {

        $this->layout = '_layout.perfilUsuario';
        $Usuario = new Usuario();
        $Usuario->codgusario = $this->getParametro(0);
        $api = new ApiUsuario();

        $query = $api->Deletar($Usuario);
        $this->dados = array('return' => $query);
        header("Location:" . APP_ADMIN . 'usuario/listar_usuario');
    }
    /**
     * 
     */
    
    function eliminar_sugestao(){
        
     $this->layout = '_layout.perfilUsuario';
        $com = new Comentario();
        $api = new ApiComentario();
        $com->id_user = $this->getParametro(0);
      

        $query = $api->Deletar_comentario($com);
        $this->dados = array('return' => $query);
        header("Location:" . APP_ADMIN . 'usuario/comentario_sugestao');     
        
        
    }

    /**
 * 
 */
  function listar_usuario() {
       
        $this->layout = '_layout.perfilUsuario';
        $api = new ApiUsuario();
        $this->dados = array(
            'listUsuario' => $api->getList()
        );
        $this->view();
    }
/**
 * PRA CADASTRAR e ACTUALIZAR O UTILIZADOR QDO O ADMINISTRADOR MANDAR OS DADOS DO FORMULARIO
 */
   function salvarCadastro() {
      $this->layout = '_layout.perfilUsuario';
        $usuario = new Usuario();
       // $usuario->codgusario = $this->getParametro(0);
        $api = new ApiUsuario();
        $sec = new Validador();
        
        if(isset($_FILES["foto"]["name"])){
          $arquivo =$_FILES["foto"]["name"];
          $path_dir = "fotos/". $arquivo;
          $vs= move_uploaded_file($_FILES["foto"]["tmp_name"], $path_dir);
        }
        /**
         *  recebe
         */
        
        $senha = $sec->criptografarUrl($_POST['senha']);
        
        
        $usuario->setNome($_POST['nome']);
        $usuario->setApelido($_POST['apelido']);
        $usuario->setNumeroEstudante(addslashes($_POST['numeroEstudante']));
        $usuario->setTelefone($_POST['telefone']);
        $usuario->setEmail($_POST['email']);
        $usuario->setNivel($_POST['nivel']);
        $usuario->setSenha($senha);
        $usuario->setFoto(isset($arquivo)?$arquivo:'');
        
        /**
         * condiçao pra actualizar ou inserir 
         */
        if(isset($_POST['codgusario']) && !empty($_POST['codgusario'])):
            
        
             $query = $api->salavarInsert(new Usuario('POST'));
            
            else:
            $query = $api->salavarInsert($usuario);
            
        endif;
        
        $this->dados = array('salvar' => $query);
        $this->view();
    }
/**
 * 
 */
   function deletar() {

        $Usuario = new Usuario();
        $Usuario->codgusario = $this->getParametro(0);
        $Usuario->nome = $this->getParametro(1);
        $this->dados = array('dados' => $Usuario);

        $this->view();
    }

    /**
     * 
     */
   function confirmaDeletar() {
        $Usuario = new Usuario();
        $Usuario->codgusario = $this->getParametro(0);
        $Usuario->nome = $this->getParametro(1);

        $api = new ApiUsuario();

        $query = $api->Deletar($Usuario);
        $this->dados = array('dados' => $Usuario, 'return' => $query);

        $this->view();
    }

    /**
     * controller pra listar os nomes de cada um q for solicitado no comentario
     * @param type $id
     */
    function  mostraNomes($id){
        $api = new ApiComentario();
         $this->dados =$api->dados_Nomes($id);
        
        return $this->dados;
    }
    
}
