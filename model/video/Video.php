<?php



namespace model\video;
/**
 * Description of Vdeo
 *
 * @author ismael-if
 */
class Video {
   
    public $id;
    public $titulo;
    public $curso;
    public $descricao;
    public $arquivo;
    
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getCurso() {
        return $this->curso;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getArquivo() {
        return $this->arquivo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setCurso($curso) {
        $this->curso = $curso;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
    }


    
}
