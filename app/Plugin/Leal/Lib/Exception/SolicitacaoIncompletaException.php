<?php

    /**
     * Description of SolicitacaoIncompletaException
     *
     * @author Andre Araujo
     */
    class SolicitacaoIncompletaException extends CakeException {

        public function __construct() {
            parent::__construct('A solicita��o n�o pode ser confirmada pois n�o foi preenchida corretamente.');
        }

    }
    