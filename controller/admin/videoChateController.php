<?php



namespace controller\admin;

use app_controllerModel\videoChate\Api_videoChate;
use lib\Controller;
use model\video\Video;
use helper\Seguranca;
use helper\Validador;

/**
 * Description of videoController
 *
 * @author ismael-if
 */
class videoChateController extends Controller{

        
    public function __construct() {
        parent::__construct();
        new Seguranca();
        $this->title=" UNIA-Usuario";
    }

    /**
     *
     */
    function registar_video(){
        $this->layout='_layout.perfilUsuario';
        $this->view();
    }

    /**
     *
     */
    function salvar_registo_video(){
         $this->layout='_layout.perfilUsuario';
         $api = new Api_videoChate();
         $sec = new Validador;
          $v = new Video();

          if(isset($_POST) && !empty($_POST['titulo'])):


          $arquivo =$_FILES["arquivo"]["name"];
          $path_dir = "videos/". $arquivo;
          $vs= move_uploaded_file($_FILES["arquivo"]["tmp_name"], $path_dir);

         $v->setTitulo($_POST['titulo']);
         $v->setCurso($_POST['curso']);
         $v->setDescricao($_POST['descricao']);
         $v->setArquivo($arquivo);

          $this->dados = array('resposta' => $api->registarVideo($v));
          //print_r( $this->dados['resposta']);


         endif;
        $this->view();
    }

    /**
     *
     */
    function listar_video(){


        $this->layout='_layout.perfilUsuario';
         $api = new Api_videoChate();

         $this->dados = array(
            'listar' => $api->Listar_tudo()
        );

        $this->view();
    }
    /**
     *
     */
    
    function visualizar(){
      $this->layout = '_layout.perfilUsuario';
        
        
      $this->view(); 
    }
            
    function visualiza(){

        $this->layout = '_layout.perfilUsuario';
        $vi = new Video;
        $vs = $this->getParametro(0);
        $_SESSION['visualiza'] = $vs;
        
       header("Location:" . APP_ADMIN . 'videoChate/visualizar');
    }
    /**
     *
     */
    function gravar(){
        $this->layout = '_layout.perfilUsuario';

          $this->view();
    }
       /**
        *
        */
    function conferencia(){
         $this->layout = '_layout.perfilUsuario';

          $this->view();


    }
    /**
     * eliminar video
     */
    function eliminar_video(){

        $this->layout = '_layout.perfilUsuario';
        $vi = new Video;
        $vi->id = $this->getParametro(0);
        $api = new Api_videoChate();

        $query = $api->Deletar($vi);
        $this->dados = array('return' => $query);
        header("Location:" . APP_ADMIN . 'videoChate/listar_video');


    }

    function actualizar_video(){


    }

}
