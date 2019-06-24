<?php

namespace app_controllerModel\Contas;
use lib\Model;
use model\conta_pagamento\Pagamento;
use model\conta_pagamento\Conta;
use PDO;


class ApiConta extends Model{
      
    
    
    public function Listar_detalhe_pagamento(Pagamento $obj){
     $query = $this->First($this->Listar("SELECT * FROM pagamento WHERE id = '{$obj->id}'"));
       
      // $this->setObject($obj, $query);
        return $query;
    }
    
    
    
    public function Deletar(Pagamento $obj){
          
     if(empty($obj->id)){
      
         return array('sucess'=>FALSE, 'feedback'=>'codigo nao informado pra eliminar');
     }
     
       return $this->Apagar(array('id'=>$obj->id), 'pagamento');      
        }
    
     
    /**
     * Função responsavel pela listagem das contas do usario
     * @return type
     */
  
       function listar_conta(){
         return $this->Listar("SELECT * FROM usuario");
    }
    /**
     * 
     * @return type
     */
    function listar_pagamentos(){
         return $this->Listar("SELECT * FROM pagamento");
    }
    /**
     * 
     * @param type $id
     * @return type
     */
    function lista_cada_conta($id){
        
         $query = $this->First($this->Listar("SELECT id_user, estado FROM conta WHERE id_user = '{$id}'"));
       
      // $this->setObject($obj, $query);
        return $query;
        
    }
    
    function DesativarConta(Conta $dados){
           
        
            $valor = $this->lista_cada_conta($dados->getId_user());
            
            if($valor->id_user > 0){
                    try {
            
            $result = $this->con->prepare('UPDATE conta SET estado=(:estado) WHERE id_user=(:id_user);');
            $result->bindParam(':estado', $dados->getEstado(), PDO::PARAM_STR);
            $result->bindParam(':id_user', $dados->getId_user(), PDO::PARAM_INT);
            $retorno = $result->execute();
            
           
             if($retorno):
                      
                  return TRUE;
                  
              
                 else:
                     return FALSE;

               endif;

            } catch (Exception $exc) {
            return $exc->getMessage();
                  }
           }
           else {
            $result = $this->con->prepare('INSERT INTO conta(id_user, estado) VALUES (:id_user, :estado);');
            $result->bindValue(':id_user', $dados->getId_user(), PDO::PARAM_INT);
            $result->bindValue(':estado', $dados->getEstado(), PDO::PARAM_STR);
           
            $retorno = $result->execute();
            
            if( $retorno):
                      
                  return TRUE;
                 else:
                     return FALSE;

               endif;
               
           }
    }
    
    /**
     * 
     * @param Conta $dados
     * @return boolean
     */
    
          function AtivarCota(Conta $dados) {
              
             $valor = $this->lista_cada_conta($dados->getId_user());
            
            if($valor->id_user > 0){
             
     try {
            $result = $this->con->prepare('UPDATE conta SET estado=(:estado) WHERE id_user=(:id_user);');
            $result->bindParam(':estado', $dados->getEstado(), PDO::PARAM_STR);
            $result->bindParam(':id_user', $dados->getId_user(), PDO::PARAM_INT);
            $retorno = $result->execute();
           
            if ($retorno) :
                  return array('sucess' => true);
                   
               else :
                   return FALSE; 
                
            endif;
              } catch (Exception $exc) {
            return $exc->getMessage();
           }
           
            }else{
             
             $result = $this->con->prepare('INSERT INTO conta(id_user, estado) VALUES (:id_user, :estado);');
            $result->bindValue(':id_user', $dados->getId_user(), PDO::PARAM_INT);
            $result->bindValue(':estado', $dados->getEstado(), PDO::PARAM_STR);
           
            $retorno = $result->execute();
            
            if( $retorno):
                      
                  return TRUE;
                 else:
                  return FALSE;

               endif;
         }
    
    }


    /**
  * 
  * @param Pagamento $dados
  * @return boolean
  */
     public function registar_Pagamento(Pagamento $dados) {
          
        try {

           $result = $this->con->prepare('INSERT INTO pagamento (numeroEstudante, email, mes, borderom, numero_de_meses, valorPago)'
             . ' VALUES (:numeroEstudante, :email, :mes, :borderom, :numero_de_meses, :valorPago);');
            $result->bindValue(':numeroEstudante', $dados->getNumeroEstudante(), PDO::PARAM_INT);
            $result->bindValue(':email', $dados->getEmail(), PDO::PARAM_STR);
            $result->bindValue(':mes', $dados->getMes(), PDO::PARAM_STR);
            $result->bindValue(':borderom', $dados->getBorderom(), PDO::PARAM_INT);
            $result->bindValue(':numero_de_meses', $dados->getNumero_de_meses());
            $result->bindValue(':valorPago', $dados->getValorPago());
            
            $retorno = $result->execute();
              
            if ($retorno) :
                  return array('sucess' => true, 'feedback' =>'operação do pagamento realizada com sucesso');
                   
               else :
                   return FALSE; 
                
            endif;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
    }
    
    
}
