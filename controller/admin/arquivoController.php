<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller\admin;
use PDO;
use lib\Controller;
use app_controllerModel\arquivo\ApiArquivo;
use helper\Seguranca;
use helper\Validador;
use model\arquivo\Arquivo;

/**
 * Description of arquivoController
 *
 * @author Helmer Almeida
 */
class arquivoController extends Controller {
    
    public function __construct() {
        parent::__construct();
        new Seguranca();
        $this->title=" UNIA-Usuario";
    }
    
    
    function cadastrar(){
        
       $this->layout='_layout.perfilUsuario';
       $this->view();
    }
    
    function salvar_cadastrar(){
        $this->layout='_layout.perfilUsuario';
         $api = new ApiArquivo();
         $sec = new Validador;
         $arq = new Arquivo;

          if(isset($_POST) && !empty($_POST['nome'])):


          $arquivo =$_FILES["ficheiro"]["name"];
          $path_dir = "arquivos/". $arquivo;
          $vs= move_uploaded_file($_FILES["ficheiro"]["tmp_name"], $path_dir);

          $arq->setNome($_POST['nome']);
          $arq->setArea_formacao($_POST['area_formacao']);
          $arq->setDescricao($_POST['descricao']);
          $arq->setFicheiro($arquivo);
          $arq->setId_user($_SESSION['unia']->codgusario);  

          $this->dados = array('resposta' => $api->registarArquivo($arq));
         
         endif;
        $this->view();
    }
            
    function listar(){
        $this->layout='_layout.perfilUsuario';
         $api = new ApiArquivo();
         $sec = new Validador;
         $this->dados = array(
            'listar' => $api->Listar_tudo()
        );
        
        $this->view();
        
     }
    
     
     function eliminar(){
         
        $this->layout='_layout.perfilUsuario';
         $api = new ApiArquivo();
         $sec = new Validador;
         $arq = new Arquivo;
         
        $arq->setId_user($this->getParametro(0));
        $query = $api->Deletar($arq);
        $this->dados = array('return' => $query);
        header("Location:" . APP_ADMIN . 'arquivo/listar');
         
     }
     
     
     
     function  visualizar(){
       $this->layout='_layout.perfilUsuario';
       $api = new ApiArquivo();
       $id = $this->getParametro(0);
       $view_listar = $api ->listar_cada_arquivo($id);
        
        //$_SESSION['visualiza'] = $id;
       // header("Location:" . APP_ADMIN . 'arquivo/visualizar');
       header('content-type: application/pdf');
       readfile('././arquivos/'.$view_listar->ficheiro);
      
     }
     
      
     
     
}
