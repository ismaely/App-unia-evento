<?php
namespace model\usuario;

use lib\Objecto;
/**
 * Description of Usuario
 *
 * @author ismael-if
 */
class Usuario extends Objecto{
    
    public $codgusario;
    public $nome;
    public $apelido;
    public $telefone;
    public $numeroEstudante;
    public $nivel;
    public $email;
    public $senha;
    public $foto;
    
    function getCodgusario() {
        return $this->codgusario;
    }

    function getNome() {
        return $this->nome;
    }

    function getApelido() {
        return $this->apelido;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getNumeroEstudante() {
        return $this->numeroEstudante;
    }

    function getNivel() {
        return $this->nivel;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function getFoto() {
        return $this->foto;
    }

    function setCodgusario($codgusario) {
        $this->codgusario = $codgusario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setApelido($apelido) {
        $this->apelido = $apelido;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setNumeroEstudante($numeroEstudante) {
        $this->numeroEstudante = $numeroEstudante;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }


    
    
}
