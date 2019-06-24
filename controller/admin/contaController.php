<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller\admin;

use lib\Controller;
use helper\Seguranca;
use app_controllerModel\Contas\ApiConta;
use model\conta_pagamento\Pagamento;
use model\conta_pagamento\Conta;

/**
 * Description of contaController
 *
 * @author ismael-if
 */
class contaController extends Controller {

    /**
     * construtor que esta chamar o construtor pai
     */
    public function __construct() {
        parent::__construct();

        new Seguranca();
        $this->title = " UNIA-Usuario";
    }

    function listar_contas() {

        $this->layout = '_layout.perfilUsuario';
        $api = new ApiConta();
        $this->dados = array(
            'list' => $api->listar_conta()
        );
        $this->view();
    }

    /**
     * controller que vai chamar o formulario que ativa as contas
     */

    /**
     * 
     */
    function ativar_conta() {
        $this->layout = '_layout.perfilUsuario';
        $api = new ApiConta();
        $conta = new Conta;
        $conta->setId_user($this->getParametro(0));
        $conta->setEstado("Ativado");
        $this->dados = array(
            'list' => $api->AtivarCota($conta)
        );

        header("Location:" . APP_ADMIN . 'conta/listar_contas');
    }

    function listarCadaConta($id) {
        $api = new ApiConta();
        return $api->lista_cada_conta($id);
    }

    /**
     * 
     */
    function desativar_conta() {
        $this->layout = '_layout.perfilUsuario';
        $api = new ApiConta();
        $conta = new Conta;
        $conta->setId_user($this->getParametro(0));
        $conta->setEstado("Desativada");
        $this->dados = array(
            'list' => $api->DesativarConta($conta)
        );

        header("Location:" . APP_ADMIN . 'conta/listar_contas');
    }

    /**
     * controller responsavel pela listagem dos pagamentos das contas
     */
    function listar_pagamento() {

        $this->layout = '_layout.perfilUsuario';
        $api = new ApiConta();
        $this->dados = array(
            'list' => $api->listar_pagamentos()
        );
        $this->view();
    }

    /**
     * controller que vai chamar o formulario para registar o pagamento
     */
    function registar_pagamento() {

        $this->layout = '_layout.perfilUsuario';

        $this->view();
    }

    /**
     * controller que vai salar os dados que vao vir do formulario do pagamento
     */
    function salvar_Pagamento() {
        $this->layout = '_layout.perfilUsuario';

        if (isset($_POST)) {
            $pag = new Pagamento();
            $api = new ApiConta();

            $pag->setBorderom($_POST['borderom']);
            $pag->setEmail($_POST['email']);
            $pag->setMes($_POST['mes']);
            $pag->setNumeroEstudante($_POST['numeroEstudante']);
            $pag->setNumero_de_meses($_POST['numero_de_meses']);
            $pag->setValorPago($_POST['valorPago']);

            $this->dados = array(
                'resposta' => $api->registar_Pagamento($pag));
        }
        $this->view();
    }

    function actualizar_pagamento(){
     $this->layout = '_layout.perfilUsuario';
        $vi = new Pagamento();
        $api = new ApiConta();
        $vi->id = $this->getParametro(0);
       // $query = $api->Deletar($vi);
        $this->dados = array('dados' => $api->Listar_detalhe_pagamento($vi));
        $this->view();
        //header("Location:" . APP_ADMIN . 'conta/listar_pagamento');   
        
        
        
    }
    
    function eliminar_pagamento(){
        
        $this->layout = '_layout.perfilUsuario';
        $vi = new Pagamento();
        $api = new ApiConta();
        $vi->id = $this->getParametro(0);
       // $query = $api->Deletar($vi);
        $this->dados = array('resposta' => $api->Deletar($vi));
        //$this->view();
        header("Location:" . APP_ADMIN . 'conta/listar_pagamento');
    }
    
    
}
