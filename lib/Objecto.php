<?php

 namespace lib;

/**
 * classe responsavel por pegar os dados que vem do formulario pra cadastro ou alteração em POST
 *  vai se carregar automatico
 * @author ismael-if
 */
class Objecto {
   
    public function __construct($method = null, $all = true) {
        if($method == 'POST'){
            foreach ($_POST as $key => $valor) {
                $this->$key = $valor;  // $usuario = $_post['nome']
//                var_dump($_POST);
            }
       }
      
       /**
        *  a que é pra pegar os arquivos
        */
       if (isset($_FILES)) {
           
            foreach ($_FILES as $key => $valor) {
               if($all || isset($this->$key)){
                   $this->$key = $valor;
               }
            } 
    }
    
    


}
    
    
   
}
