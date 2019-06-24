<?php
 session_start(); 

 define('APP_ROOT', 'App_universidade_independente');
 define('APP_LOGIN', 'http://localhost/App_universidade_independente/site/sessao/');
 define('APP_LOGOUTLOUCK', 'http://localhost/App_universidade_independente/site/sessao/');
 define('APP_CADASTRO', 'http://localhost/App_universidade_independente/site/sessao/');
 define('APP_URL', 'http://localhost/App_universidade_independente/');
 define('APP_SITE_HOME', 'http://localhost/App_universidade_independente/site/home/');
 define('APP_ADMIN', 'http://localhost/App_universidade_independente/admin/');
 //define('APP_ESTUDANTE', 'http://localhost/App_universidade_independente/estudante/');
 //define('APP_DOCENTE', 'http://localhost/App_universidade_independente/docente/');
 define('FOTOS', '../App_universidade_independente/fotos/');
  
  
 
  /**
   *  pra varre o post mandado,,  a que vamos ter que verficar qdo é submetido
   */
//  if(isset($_POST)){
//      foreach ($_POST as $in => $va){
//          $_POST[$in] = str_replace("'", "\\", 'App_universidade_independente');
//      }
//  }
 
 //define('APP_ROOT', $_SERVER['HTTP_HOST'].'/App_Mvc/');
 require_once 'helper/_autoload.php';
 
 use lib\System;
 
 $syste = new System();
 
 $syste->Run();
 