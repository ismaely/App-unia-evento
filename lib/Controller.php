<?php

namespace lib;

use lib\System;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author ismael-if
 */
class Controller extends System {

    public $dados;
    public $layout = '_layout';
    private $path;
    private $pathRender;

    /**
     * pra view
     */
    protected $title = null;
    protected $description = null;
    protected $keywords;
    protected $image;
    protected $captaController;
    protected $captaAcao;
    protected $captaParametro;

    public function __construct() {
        parent::__construct();
    }
/**
 * 
 * @param type $render
 */
    private function setPath($render) {
        if (is_array($render)) {
            foreach ($render as $key) {
                $path = 'view/' . $this->getArea() . '/' . $this->getController() . '/' . $key . '.phtml';
                $this->fileExiste($path);
                $this->path[] = $path;

                }
        } else {
            $this->pathRender = is_null($render) ? $this->getAcao() : $render;
            $this->path = 'view/' . $this->getArea() . '/' . $this->getController() . '/' . $this->pathRender . '.phtml';
            $this->fileExiste($this->path);
        }
    }
/**
 * 
 * @param type $file
 */
    private function fileExiste($file) {

        if (!file_exists($file)) {
            die('Não foi localizado o arquivo ' . $file);
        }
    }
/**
 * 
 * @param type $render
 */
    public function view($render = null) {

        $this->title = is_null($this->title) ? 'Meu titulo' : $this->title;
        $this->description = is_null($this->description) ? 'minha descrição' : $this->description;
        $this->keywords = is_null($this->keywords) ? 'minha palvra chave da vida fe, e dedicação, paciencia' : $this->keywords;

        $this->setPath($render);

        if (is_null($this->layout)) {
            $this->render();
        } else {
            $this->layout = "content/{$this->getArea()}/areaView/{$this->layout}.phtml";
            if (file_exists($this->layout)) {
                $this->render($this->layout);
            } else {
                die("não foi possivel localizar o layout");
            }
        }
    }
/**
 * 
 * @param type $file
 */
    public function render($file = null) {

        if (is_array($this->dados) && count($this->dados) > 0) {
            extract($this->dados, EXTR_PREFIX_ALL, 'view');
            extract(array(
                'controller' => (is_null($this->captaController) ? '' : $this->captaController),
                'action' => (is_null($this->captaAcao) ? '' : $this->captaAcao),
                'params' => (is_null($this->captaParametro) ? '' : $this->captaParametro)
                    ), EXTR_PREFIX_ALL, 'caption');
        }

        if (!is_null($file) && is_array($file)) {
            foreach ($file as $key) {
                include ($key);
            }
        } elseif (is_null($file) && is_array($this->path)) {
            foreach ($this->path as $l) {
                include ($l);
            }
        } else {
            $file = is_null($file) ? $this->path : $file;
            file_exists($file) ? include ($file) : die($file);
        }
    }
/**
 *  função que vai desviar pra o perfil do usario quando fazer o login em função do seu nivel, q esta guardada na sessão
 *  ESTUDANTE -->1
 *  DOCENTE-->2
 *  ADMININISTRADOR-->3
 */
    public function perfil() {

       
     if($_SESSION['unia']->nivel > 0) {
              $this->layout = '_layout.perfilUsuario';
            header("Location:" . APP_ADMIN . 'home/perfilUsuario');
        }
    }

}
