<?php

    /**
     * Description of SolicitacaoEtapaAnteriorNaoPreenchidaException
     *
     * @author Andre Araujo
     */
    class SolicitacaoEtapaNaoPreenchidaException extends CakeException {

        private $etapa;

        public function __construct($etapa) {
            $this->setEtapa($etapa);
            parent::__construct('Alguns dados não foram informados corretamente');
        }

        public function setEtapa($etapa) {
            $this->etapa = $etapa;
        }

        public function getEtapa() {
            return $this->etapa;
        }

    }
    