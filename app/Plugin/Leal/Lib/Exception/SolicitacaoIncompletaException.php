<?php

    /**
     * Description of SolicitacaoIncompletaException
     *
     * @author Andre Araujo
     */
    class SolicitacaoIncompletaException extends CakeException {

        public function __construct() {
            parent::__construct('A solicitaчуo nуo pode ser confirmada pois nуo foi preenchida corretamente.');
        }

    }
    