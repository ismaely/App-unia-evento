<?php
namespace lib;
//use lib\Constante;
/**
 * classe responsavel pra fazer a conexao do banco de dados 
 */

use PDO;


  class Conexao {
      
      
    private static $Host = '127.0.0.1';
    private static $User = 'root';
    private static $Pass = '';
    private static $Dbsa = 'unia';

    
      private static $instance=null;
      
     
    private static function conectar(){
        
        try {
            if(self::$instance==NULL):
                
                $dsn = 'mysql:host=' . self::$Host . ';dbname=' . self::$Dbsa;
                $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                self::$instance=new PDO($dsn, self::$User ,  self::$Pass, $options);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                   
            endif;
            
            
        } catch (PDOException $exc) {
            echo "erro". $exc->getTrace();
        }
        
        return self::$instance;
          
    }
    public static function chamaConexao(){
        return self::conectar();
    }
  
}

