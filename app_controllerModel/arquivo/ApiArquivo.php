<?php
namespace app_controllerModel\arquivo;
use lib\Model;
use PDO;
use model\arquivo\Arquivo;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiArquivo
 *
 * @author Helmer Almeida
 */
class ApiArquivo extends Model{
    
    
    public function listar_cada_arquivo($id){
         $query = $this->First($this->Listar("SELECT * FROM arquivo WHERE id = '{$id}'"));
         
      
          return $query;
          }
    
    
     public function Listar_tudo(){
        return $this->Listar("SELECT * FROM arquivo");
    }
    
    
    
    public function Deletar(Arquivo $obj){
          
     if(empty($obj->getId_user())){
      
         return array('sucess'=>FALSE, 'feedback'=>'codigo nao informado pra eliminar');
     }
     
       return $this->Apagar(array('id'=>$obj->getId_user()), 'arquivo');      
      }
    
        
        
        
        
        
     public function registarArquivo(Arquivo $dados) {
        try {
            
          //  $cnx = Conexao::chamaConexao();

           $result = $this->con->prepare('INSERT INTO arquivo (id_user, nome, area_formacao, descricao, ficheiro)'
             . ' VALUES (:id_user, :nome, :area_formacao, :descricao, :ficheiro);');
            $result->bindValue(':id_user', $dados->getId_user(), PDO::PARAM_INT);
            $result->bindValue(':nome', $dados->getNome(), PDO::PARAM_STR);
            $result->bindValue(':area_formacao', $dados->getArea_formacao(), PDO::PARAM_STR);
            $result->bindValue(':descricao', $dados->getDescricao(), PDO::PARAM_STR);
            $result->bindValue(':ficheiro', $dados->getFicheiro());
            
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
