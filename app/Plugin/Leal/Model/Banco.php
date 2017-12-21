<?php

    /**
     * Description of Banco
     *
     * @author Andre Araujo
     */
    class Banco extends LealAppModel {

        /**
         * Nome da tabela
         * @var string
         */
        public $useTable = 'banco';

        /**
         * Campo de exibi��o
         * @var srting
         */
        public $displayField = 'codigo_descricao';

        /**
         * Ordena��o padr�o
         * @var string
         */
        public $order = 'Banco.codigo_descricao ASC';

        /**
         * Campos virtuais
         * @var array
         */
        public $virtualFields = array(
            'codigo_descricao' => 'CONCAT(Banco.codigo, " - ", Banco.descricao)',
        );

        /**
         * Regras de valida��o
         * @var array
         */
        public $validate = array(
            'codigo' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'C�digo n�o pode ser vazio',
                    'last' => true,
                ),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'C�digo deve ser �nico',
                ),
            ),
            'descricao' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Descri��o n�o pode ser vazio',
                    'last' => true,
                ),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Descri��o deve ser �nico',
                ),
            ),
        );

    }
    