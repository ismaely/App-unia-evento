<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller\admin;
use lib\Controller;
use app_controllerModel\sessao\ApiSessao;
use model\sessao\Sessao;

/**
 * Description of sessaoController
 *
 * @author almeida-if
 */
class sessaoController extends Controller{
   
    public function index(){
        $this->title='Acesso Restristo a usuario';
        $this->layout='_layout.login';
        $this->view();
        
    }
   
     
    public function logout(){
        $api = new ApiSessao();
         $api->logout();
        
    }
 /**
  * 
  
        public function validar(){
        $api = new ApiSessao();
        $api->login(new Sessao('POST'));
            
            
    }
    */
      
    
}
