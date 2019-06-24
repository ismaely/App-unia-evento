<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller\admin;

use helper\Seguranca;
use lib\Controller;

/**
 * Description of homeController
 *
 * @author ismael-if
 */
class homeController extends Controller{
  
    public function __construct() {
        parent::__construct();
        
        new Seguranca();
    }
   
    public function perfilUsuario(){
          $this->title="Admin Unia";
          $this->layout='_layout.perfilUsuario';    
          $this->view();  
    }
    
    
   
    public function index(){
        $this->view();   
    }
    
}
