<?php

namespace app_controllerModel\usuario;
use lib\Model;
use model\usuario\Usuario;
use model\usuario\Estado_pessoal;
use PDO;

/**
 * Description of apiUsuario
 *
 * @author ismael-if
 */
class ApiUsuario  extends Model{
   
    
    /**
     * Função que vai listar os dados do utilizador especifico que sera solicitado
     * @param Usuario $obj
     */
    public function getListar(Usuario $obj){
       $query = $this->First($this->Listar("SELECT * FROM usuario WHERE codgusario = '{$obj->codgusario}'"));
       $this->setObject($obj, $query);
        return $query;
    }
    
    /**
     * função que vai selecionar os detelhe do usario na tabela estado_pessoal, onde consta morada, universidade, curso..
     * @param Usuario $obj
     */
     public function Listar_detalhe_usuario(Estado_pessoal $obj){
     $query = $this->First($this->Listar("SELECT * FROM estado_pessoal WHERE codgusuario = '{$obj->codgusuario}'"));
       
       $this->setObject($obj, $query);
        return $query;
    }
    
    /**
     * função que vai selecionar os dados da tabela usario e a tabela estado_pessoal , vai sera junção das duas tabelas
     * @param Usuario $obj
     * @return type
     */
    public function Listar_informacao_cliente(Usuario $obj){
     $query = $this->First($this->Listar("SELECT * FROM usuario, estado_pessoal WHERE usuario.codgusario = '{$obj->codgusario}'"));
       
       $this->setObject($obj, $query);
        return $query;
    }
    
    
    /**
     * função que vai inserir  os dados do usuario da tabela Estado pessoal
     * @param Usuario $obj
     * @return type
     */
    public function Insert_sobreMe(Estado_pessoal $obj){
       
            return $this->Inserir($obj, 'estado_pessoal');
        } 
       
     
     /**
      * função que vai actualizar os dados do usuario da tabela Estado pessoal
      * @param Usuario $obj
      * @return type
      */
     public function Actualizar_sobreMe(Estado_pessoal $obj){
            return $this->Actualizar($obj, array('codgusuario' => $obj->codgusuario), 'estado_pessoal');
       
     }
    /**
     * 
     * @param Usuario $obj
     * @return type
     */
    public function consultas(Usuario $obj){
        
       $query = $this->First($this->Listar("SELECT * FROM usuario WHERE numeroEstudante = '{$obj->numeroEstudante}'"));
       $this->setObject($obj, $query);
       return $query;
        
    }

    

    /**
     * função que vai listar todos dados da tabela o usuario
     * @return type
     */
    public function getList(){
        return $this->Listar("SELECT * FROM usuario");
    }
 /**
  * QUE VAI ACTUALIZAR TODOS OS CAMPOS 
  * @param Usuario $obj
  * @return type
  */
    public function actualizar_dados(Usuario $obj){
        $id = $_SESSION['unia']->codgusario;
         return $this->Actualizar($obj, array('codgusario' =>$id ), 'usuario');
    }

    /**
     * FUNÇÃO QUE VAI ACTUALIZAR SENHA
     */
    public function ActualizarSenha($campos){
        
        return $this->Actualizar_mais("usuario", 'senha ='.$campos, 'codgusario = '.$_SESSION['unia']->codgusario); 
        
    }

     /**
    * Função que vai cadastrar e actualizar o usuario ............
    * @param Usuario $obj
    */
    public function salavarInsert(Usuario $obj){
        
        if(!empty($obj->codgusario) && $obj->codgusario > 0){
            return $this->Actualizar($obj, array('codgusario' => $obj->codgusario), 'usuario');
       } else { 
           try {

          //  $cnx = Conexao::chamaConexao();

           $result = $this->con->prepare('INSERT INTO usuario (nome, apelido, telefone, numeroEstudante, nivel, email, senha, foto)'
             . ' VALUES (:nome, :apelido, :telefone, :numeroEstudante, :nivel, :email, :senha, :foto);');
            $result->bindValue(':nome', $obj->getNome(), PDO::PARAM_STR);
            $result->bindValue(':apelido', $obj->getApelido(), PDO::PARAM_STR);
            $result->bindValue(':telefone', $obj->getTelefone(), PDO::PARAM_INT);
            $result->bindValue(':numeroEstudante', $obj->getNumeroEstudante());
            $result->bindValue(':nivel', $obj->getNivel(), PDO::PARAM_INT);
            $result->bindValue(':email', $obj->getEmail(),  PDO::PARAM_STR);
            $result->bindValue(':senha', $obj->getSenha(),  PDO::PARAM_STR);
            $result->bindValue(':foto', $obj->getFoto(), PDO::PARAM_STR);
            
               $retorno = $result->execute();
               
             
               // $dados->setIdUlizador($cnx->lastInsertId());
             
            if ($retorno) :
                  return array('sucess' => true, 'feedback' =>'operação realizada com sucesso');
                   
               else :
                   return array('sucess' =>FALSE, 'feedback' =>'operação nao realizada ');  
                
            endif;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
           
          // return $this->Inserir($obj, 'usuario');
           
      }
       
        
     }
 
       /**
        *  função responsavel por apagar os dados do utilizador
        * @param Usuario $obj
        * @return type
        */
     public function Deletar(Usuario $obj){
          
     if(empty($obj->codgusario)){
      
         return array('sucess'=>FALSE, 'feedback'=>'codigo nao informado pra eliminar');
     }
     
     return $this->Apagar(array('codgusario'=>$obj->codgusario), 'usuario');      
        }
    


        
    

}
