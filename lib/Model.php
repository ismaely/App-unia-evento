<?php

namespace lib;
//use model\video\Video;


/**
 * Description of Model
 *
 * @author ismael-if
 */
class Model extends Conexao{
   
    protected $con;
   


    public function __construct() {
        try {
            
            $this->con = Conexao::chamaConexao();
            
            
        } catch (Exception $exc) {
            die( $exc->getMessage());
        }

      
    }
    /**
     * 
     * @param type $sql
     * @return type
     */
    public function Listar($sql){
        
        try {
            $state = $this->con->prepare($sql);
            $state->execute();
        } catch (Exception $exc) {
            die($exc->getMessage(). " erro ao listar no Model".$sql) ;
        }
        $array = array();
        while ($row = $state->fetchObject()){
            $array[] = $row;
        }
        return $array;  
            
    }
    /**
     * 
     * @param type $obj
     * @param type $tabela
     * @return type
     */
    public function Inserir($obj, $tabela){
        
        try { 
            
     $sql = "INSERT INTO {$tabela} (".implode(",", array_keys((array) $obj)).") VALUES ('".implode("','", array_values((array) $obj)) ."')";
  
  $state = $this->con->prepare($sql);
     $state->execute(array('widgets'));
            
        } catch (\PDOException $exc) {
              die($exc->getMessage(). " erro a inserir ".$sql) ;
        }
        
        return array('sucess' => true, 'feedback' =>'operação realizada com sucesso', 'codigo'=> $this->Last($tabela));
            
    }/**
     *  função responsavel pra actualizar todos campos da tabela 
     * @param type $obj
     * @param type $condicao
     * @param type $tabela
     * @return type
     */
    public function Actualizar($obj, $condicao, $tabela){
        try {
            foreach ($obj as $ind => $val){
                
                if(!empty($val)):
                 $dados[]= "`{$ind}` " ."= '{$val}'";   
                    
                endif;
              //  $dados[]= "`{$ind}` " .(is_null($val) ? "NULL" : "= '{$val}'");
            }
            foreach ($condicao as $ind => $val){
                $where[]= "`{$ind}` = " .(is_null($val) ? " IS NULL" : "'{$val}'");
            }
            
            $sql = "UPDATE {$tabela} SET " .implode(',', $dados). " WHERE ".implode('AND', $where);
            
            $state = $this->con->prepare($sql);
            $state->execute(array('widgets'));
            
            
        } catch (Exception $exc) {
          die($exc->getMessage(). " ".$sql) ;
        }
            
        return array('sucess' =>true, 'feedback' =>'');  
    }
    
    /**
     * 
     * @param type $tabela
     * @param type $campos
     * @param type $condicao
     * @return type
     */
    public function Actualizar_mais($tabela, $campos, $condicao){
       
        try {
        $sql = "UPDATE {$tabela} SET {$campos} WHERE {$condicao}";
        
        $state = $this->con->prepare($sql);
         $state->execute(array('widgets'));
         
            
            } catch (Exception $exc) {
          die($exc->getMessage(). " ".$sql) ;
        }
        return array('sucess' =>true, 'feedback' =>'');  
    }

    /**
     * 
     * @param type $condicao
     * @param type $tabela
     * @return type
     */
    public function Apagar($condicao, $tabela){
        try {
            foreach ($condicao as $key => $value) {
                    $where[] = !is_null($value) ? "{$key} = {$value} " : "IS NULL";
            }
            
           $sql = "DELETE FROM {$tabela} WHERE ". implode('AND', $where); 
           $state= $this->con->prepare($sql);
           $state->execute(array('widgets'));
           
        } catch (\PDOException $exc) {
            die($exc->getMessage(). " erro ao eliminar { " .$sql ."}") ;
        }
        return array('sucess' =>TRUE , 'feedback' =>' eleiminado com Sucesso');        
            
    }
    /**
     * 
     * @param type $tabela
     * @return type
     */
    public function Last($tabela){
        try {
            $state = $this->con->prepare("SELECT last_insert_id() as last FROM {$tabela}");
            $state->execute();
            $state = $state->fetchObject();
        } catch (Exception $exc) {
           die($exc->getMessage(). " erro no ultimo id") ;
        }
        return $state->last;
    }
    
    /**
     * 
     * @param type $obj
     * @param type $tabela
     * @return type
     
     public function consulta_buscas($obj, $tabela){
        
        try {
             foreach ($obj as $key => $value) {
                     $campo = !empty( $key->$value) ? $key : "" ;
                     $valor = !empty( $key->$value) ? $value: NULL;
            }
       $sql = "SELECT * FROM {$tabela} WHERE ".$campo."=".$valor;
     $state = $this->con->prepare($sql);
     $state->execute(array('widgets'));
            
        } catch (\PDOException $exc) {
            var_dump($obj);
              die($exc->getMessage(). " ERRO A FAZER CONSULTA <br> ".$sql) ;
        }
        
    }
        return $state =$state->fetchObject();  
            
    } */ 
    
    /**
     * 
     * @param type $obj
     * @return type
     */
    public function First($obj){
        
        if(isset($obj[0])){
            return $obj[0];
        } else {
            return NULL;    
        }
        
    }
    /**
     * PRA VERFICAR SE É MESMO UM OBJECTO
     * @param type $obj
     * @param type $Values
     * @param type $Exits
     */
    public function setObject($obj, $Values, $Exits=true){
        
        if(is_object($obj)){
            if(count($Values) > 0){
                foreach ($Values as $in => $value) {
                    if (property_exists($obj,$in ) || $Exits) {
                         $obj->$in = $Values->$in;
                    }
                }
            }
        }
        
        
    }
    
     
    
}
