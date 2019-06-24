<?php

namespace app_controllerModel\comentario;
use lib\Model;
use model\comentario\Comentario;
/**
 * Description of ApiComentario
 *
 * @author ismael-if
 */
class ApiComentario extends Model{
    
    
    /**
     * 
     * @param Comentario $obj
     * @return type
     */
    public function Insert_comentrio(Comentario $obj){
        if(empty($obj->id)){
            return $this->Inserir($obj, 'comentario');
        } else {
            return $this->Actualizar($obj, array('id' => $obj->id), 'comentario');
        }
   }
 /**
  * 
  * @return type
  */
     public function getList(){
        return $this->Listar("SELECT * FROM comentario ORDER BY id DESC");
    }

    
     public function Deletar_comentario(Comentario $obj){
          
     
     return $this->Apagar(array('id'=>$obj->id_user), 'comentario');      
        }
        
      public function dados_Nomes($id){
       $query = $this->First($this->Listar("SELECT * FROM usuario WHERE codgusario = '{$id}'"));
       //$this->setObject($obj, $query);
       return $query; 
    }
}
