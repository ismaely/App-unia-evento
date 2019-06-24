<?php

namespace controller\site;
use lib\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of homeController
 *
 * @author ismael-if
 */
class homeController extends Controller{
    
    public function __construct() {
        parent::__construct() ;
        
        $this->layout ='_layout';
    }
    
    
    public function index(){
        $this->title="Universidade Independente";
       // header("Location:site/home/index");
       //  header("Location:". 'usuario/listar_usuario');
       $this->view("index");
    } 
    public function inicio(){
        $this->title="Universidade Independente";
       // header("Location:site/home/index");
       //  header("Location:". 'usuario/listar_usuario');
       $this->view();
    } 
    
     public function universidade(){
        $this->title="Universidades de Angola";
        $this->view();
    } 
      public function servico(){
        $this->title="Servico Prestados";
        $this->view();
    }
      public function cursos(){
        $this->title="Cursos Ministrados";
        $this->view();
    }
     public function quemSomos(){
        $this->title="Informação Extra";
        $this->view();
    }
    public function login(){
        $this->title="Login Usario";
        $this->view();
    }
}
