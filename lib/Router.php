<?php

namespace lib;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Router
 *
 * @author ismael-if
 */
class Router {
   
    protected $routers =array(
       'site'=>'site',
       'admin'=>'admin',
       'publica'=>'publica'
         
    );
    
    private $urlBase = APP_ROOT;
    protected $routerOnRaiz='site';
    protected $onRaiz = true;
    
}
