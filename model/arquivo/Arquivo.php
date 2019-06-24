<?php
namespace model\arquivo;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Arquivo
 *
 * @author Helmer Almeida
 */
class Arquivo {
    
    private $id_user;
    private $nome;
    private $descricao;
    private $area_formacao;
    private $ficheiro;
            
    
    function getId_user() {
        return $this->id_user;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getArea_formacao() {
        return $this->area_formacao;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setArea_formacao($area_formacao) {
        $this->area_formacao = $area_formacao;
    }

    function getFicheiro() {
        return $this->ficheiro;
    }

    function setFicheiro($ficheiro) {
        $this->ficheiro = $ficheiro;
    }


    
    
    
    
    
}
