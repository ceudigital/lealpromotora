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
         * Campo de exibiчуo
         * @var srting
         */
        public $displayField = 'descricao';

        /**
         * Ordenaчуo padrуo
         * @var string
         */
        public $order = 'TipoConta.descricao ASC';

    }
    