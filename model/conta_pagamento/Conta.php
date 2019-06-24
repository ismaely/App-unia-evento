<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model\conta_pagamento;

/**
 * Description of Conta
 *
 * @author ismael
 */
class Conta {
    
    
    private $id;
    private $id_user;
    private $estado;
    
    
    
    
    function getId() {
        return $this->id;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }


}
