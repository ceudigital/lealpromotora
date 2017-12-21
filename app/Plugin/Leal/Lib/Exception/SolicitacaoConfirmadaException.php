<?php

    /**
     * Description of SolicitacaoConfirmadaException
     *
     * @author Andre Araujo
     */
    class SolicitacaoConfirmadaException extends CakeException {

        public function __construct() {
            parent::__construct('A solicitaчуo jс foi confirmada e nуo pode ser alterada.');
        }

    }
    