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
         * Campo de exibição
         * @var srting
         */
        public $displayField = 'codigo_descricao';

        /**
         * Ordenação padrão
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
         * Regras de validação
         * @var array
         */
        public $validate = array(
            'codigo' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Código não pode ser vazio',
                    'last' => true,
                ),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Código deve ser único',
                ),
            ),
            'descricao' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Descrição não pode ser vazio',
                    'last' => true,
                ),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Descrição deve ser único',
                ),
            ),
        );

    }
    