<?php

    /**
     * Description of SolicitacaoConfirmadaException
     *
     * @author Andre Araujo
     */
    class SolicitacaoConfirmadaException extends CakeException {

        public function __construct() {
            parent::__construct('A solicita��o j� foi confirmada e n�o pode ser alterada.');
        }

    }
    