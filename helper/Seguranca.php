<?php
namespace helper;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Seguranca
 *
 * @author ismael-if
 */
class Seguranca {
   
    public function __construct() {
        if(!isset($_SESSION['unia']) || !isset($_SESSION['usuario']) || empty($_SESSION['usuario']) ){
           // header('Location:admin/sessao');
              header("Location:" .APP_LOGIN.'login');
            
        } 
    }
    
    
    
}
