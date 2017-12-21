<?php

    /**
     * Description of TipoConta
     *
     * @author Andre Araujo
     */
    class TipoConta extends LealAppModel {

        /**
         * Nome da tabela
         * @var string
         */
        public $useTable = 'tipo_conta';

        /**
         * Campo de exibi��o
         * @var srting
         */
        public $displayField = 'descricao';

        /**
         * Ordena��o padr�o
         * @var string
         */
        public $order = 'TipoConta.descricao ASC';

    }
    