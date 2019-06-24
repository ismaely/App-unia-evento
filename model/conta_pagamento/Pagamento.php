<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model\conta_pagamento;
/**
 * Description of PagamentovalorPagovalorPago
 *
 * @author ismael
 */
class Pagamento {
    public $id;
    private $numeroEstudante;
    private $email;
    private $mes;
    private $borderom;
    private $numero_de_meses;
    private $valorPago;
    
    function getNumeroEstudante() {
        return $this->numeroEstudante;
    }

    function getEmail() {
        return $this->email;
    }

    function getMes() {
        return $this->mes;
    }

    function getBorderom() {
        return $this->borderom;
    }

    function getNumero_de_meses() {
        return $this->numero_de_meses;
    }

    function getValorPago() {
        return $this->valorPago;
    }

    function setNumeroEstudante($numeroEstudante) {
        $this->numeroEstudante = $numeroEstudante;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setMes($mes) {
        $this->mes = $mes;
    }

    function setBorderom($borderom) {
        $this->borderom = $borderom;
    }

    function setNumero_de_meses($numero_de_meses) {
        $this->numero_de_meses = $numero_de_meses;
    }

    function setValorPago($valorPago) {
        $this->valorPago = $valorPago;
    }


    
    
    
    
}
