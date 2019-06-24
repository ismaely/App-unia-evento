<?php

namespace lib;
use lib\Router;

class System extends Router{
  
    private $url;
    private $exploders;
    private $area;
    private $controller;
    private $acao;
    private $parametro;
    private $runController;
    private  $teste;


    public function __construct() {
        
        $this->verfica_url();
        $this->setUrl();
        $this->setExploder();
        $this->setController();
        $this->setArea();
        $this->setAcao();
        $this->setParametro();
        
    }
    /**
     * 
     */
    function verfica_url(){
        if(!isset($_GET['url'])):
            header("Location: site/home/index");
        endif;
        
    }
    /***
     * 
     * 
     */
    private function setUrl(){
        
        $this->url= isset($_GET['url']) ? $_GET['url'] : 'site/home/index';
    }
    /**
     * 
     */
    private function setExploder(){
        
        $this->exploders= explode('/', $this->url);
        //$this->teste= $this->exploders[1];
    }
    /**
     *  a que  éonde vamos pegar a area na url ..
     * o seja a Area é uma pasta exmplo /admin/usuario/form ----> a que a area e admin
     * 
     */
    private function setArea(){
        
        foreach ($this->routers as $i => $v){
            if($this->onRaiz && $this->exploders[0] == $i){
                $this->area = $v;
                
                $this->onRaiz = FALSE;
            }
        }
        $this->area = empty($this->area) ? $this->routerOnRaiz : $this->area;
        if(!defined('APP_AREA')){
            define('APP_AREA', $this->area); 
        }
       
    }
    
    public function getArea(){
        
        return $this->area;
    }

    /**
     *  A que é onde vamos pegar o controller que na verdade é o nome da da class.
     * neste caso o controller e o que vem depois da area 
     */
    
    private function setController(){
        
   $this->controller = $this->onRaiz ? $this->exploders[1] :
 (empty($this->exploders[1]) || is_null($this->exploders[1] || !isset($this->exploders[1]) ? 'home' : $this->exploders[1] ));
    }
    /**
     * 
     * @return type
     */
    public function getController(){
        return $this->controller;
    }

 /**
 * 
 */
    private function setAcao(){
        $this->acao = $this->onRaiz ?
       (!isset($this->exploders[1]) || is_null($this->exploders[1]) || empty($this->exploders[1]) ? 'index' : $this->exploders[1]):
      (!isset($this->exploders[2]) || is_null($this->exploders[2]) || empty($this->exploders[2]) ? 'index' : $this->exploders[2]);      
         
        
    }
    
    /**
     * 
     * @return type
     */
    public function getAcao(){
        return $this->acao ;
      }

    /**
     * 
     */
    
    private function setParametro(){
        
        if($this->onRaiz){
            unset($this->exploders[0], $this->exploders[1]);
            
            
        } else {
            unset($this->exploders[0],$this->exploders[1],$this->exploders[2]);  
        }
        
        
        if(end($this->exploders) == NULL){
            array_pop($this->exploders);
            
        }
        if(empty($this->exploders)){
            $this->parametro=array();
        }
     else {
            foreach ($this->exploders as $val){
                $params[]=$val;
            }
            
            $this->parametro = $params;  
           // var_dump($params);
            //die;
      }
    }
    /**
     * função que vai validar o controllador se uma classe ou nao
     */
    private function validarController(){
        
                if(!(class_exists($this->runController))){
                    header("HTTP/1.0 404 Not Found");
                    define('ERRO',' NÃO FOI POSSIVEL LOCALIZAR O CONTROLLER   '.$this->runController);
                    define('ACAO','<br> acao -> '.$this->acao);
                   // define('CONTROLLE','<br> CONTROLLER ->'.$this->controller);
                   //  define('TESTE','<br> A URL PROPRIA->'.$this->teste);
                    include ("content/{$this->area}/areaView/404_error.phtml");
                    exit();
        }
    }
    
    /*
     * 
     */
    
    private function validarAcao(){
        
        if(!(method_exists($this->runController, $this->acao))){
            
       header("HTTP/1.0 404 Not Found");
       define('ERRO', 'Não foi possivel localizar ação '.$this->acao);
       include ("content/{$this->area}/areaView/404_error.phtml");
       exit();
        }
    }

    /**
    * 
    * @param type $indece
    * @return type 
    */
    public function getParametro($indece){
        
        return isset( $this->parametro[$indece]) ? $this->parametro[$indece] : NULL;
        
    }
    
    
    /**
     * função que vai da o arranque ao projecto 
     */
    public function Run(){
        
        $this->runController = 'controller\\'.$this->area.'\\'.$this->controller.'Controller';
        $this->validarController();
        $this->runController = new $this->runController();
        $this->validarAcao();
        
        $act = $this->acao;
        $this->runController->$act();
    }
    
    /**
     *  
     */
    private function _cleanString(){
        
        if(isset($_POST)){
            foreach ($_POST as $id => $val){
                $_POST[$id] = $this->_rulesString($val);
            }
        }
             if(isset($_GET)){
                 foreach ($_GET as $id => $val){
                     $_GET[$id] = $this->_rulesString($val);
                 }
             }
        
    }
    
    /**
     * 
     * @param type $value
     * @return type
     */
    public function _rulesString($value){
        $busca= array(
            'INSERT','insert',
            'UPDATE','update',
            'DELETE','delete',
            'SELECT','select',
            'WHERE', 'where'
        );
        $string =$value;
        $string = str_replace("'", "´", $string);
        $string = str_replace($busca, "", $string);
        return $string;
    }
    
}
