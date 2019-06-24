<?php

namespace app_controllerModel\videoChate;
use lib\Model;
use model\video\Video;
use PDO;

/**
 * Description of Api_videoChate
 *
 * @author ismael-if
 */
class Api_videoChate  extends Model{
   
    /**
     * 
     * @param Video $obj
     * @return type
     */
    public function Deletar(Video $obj){
          
     if(empty($obj->id)){
      
         return array('sucess'=>FALSE, 'feedback'=>'codigo nao informado pra eliminar');
     }
     
       return $this->Apagar(array('id'=>$obj->id), 'video');      
        }
    
     /**
     * Função que vai listar os dados do video especifico que sera solicitado
     * @param Usuario $obj
     */
    public function Listar_video(Video $obj){
       $query = $this->First($this->Listar("SELECT * FROM video WHERE id = '{$obj->id}'"));
       $this->setObject($obj, $query);
        return $query;
    }
    
    
    /**
     * função que vai listar todos dados da tabela o video
     * @return type
     */
    public function Listar_tudo(){
        return $this->Listar("SELECT * FROM video");
    }
    
    
     /**
    * Função que vai cadastrar e actualizar o video que sera registado ............
    * @param Video $obj
    */
    public function salavarInsert(Video $obj){
        
        //if(isset($obj->id) && $obj->id > 0 ){
          //  return $this->Actualizar($obj, array('id' => $obj->id), 'video');
      // } else { 
           return $this->Inserir($obj, 'video');
           
     // }
       
        
     }
     
     
     public function registarVideo(Video $dados) {
          
        try {

          //  $cnx = Conexao::chamaConexao();

           $result = $this->con->prepare('INSERT INTO video (titulo, curso, descricao, arquivo)'
             . ' VALUES (:titulo, :curso, :descricao, :arquivo);');
            $result->bindValue(':titulo', $dados->getTitulo(), PDO::PARAM_STR);
            $result->bindValue(':curso', $dados->getCurso(), PDO::PARAM_STR);
            $result->bindValue(':descricao', $dados->getDescricao(), PDO::PARAM_STR);
            $result->bindValue(':arquivo', $dados->getArquivo());
            
               $retorno = $result->execute();
             
              
            if ($retorno) :
                  return array('sucess' => true, 'feedback' =>'operação realizada com sucesso');
                   
               else :
                   return FALSE; 
                
            endif;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
    }
}
