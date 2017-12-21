<?php

    /**
     * Description of SolicitacaoTipoDocumento
     *
     * @author Andre Araujo
     */
    class SolicitacaoTipoDocumento extends LealAppModel {

        const FRENTE = 1;
        const VERSO = 2;
        const SELFIE = 3;
        const CONTRACHEQUE = 4;

        /**
         * Nome da tabela
         * @var string
         */
        public $useTable = 'solicitacao_tipo_documento';

        /**
         * has many
         * @var array
         */
        public $hasMany = array(
            'SolicitacaoDocumento' => array(
                'className' => 'Leal.SolicitacaoDocumento',
            ),
        );

    }
    