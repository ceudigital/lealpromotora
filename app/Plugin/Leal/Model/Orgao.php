<?php

    /**
     * Orgao
     *
     * @author Andre Araujo
     * 
     * @property Tabela $Tabela
     */
    class Orgao extends LealAppModel {

        /**
         * Nome da tabela
         * @var string
         */
        public $useTable = 'orgao';

        /**
         * Campo de exibi��o
         * @var string
         */
        public $displayField = 'descricao';

        /**
         * Ordena��o padr�o
         * @var string
         */
        public $order = 'Orgao.descricao ASC';

        /**
         * Regras de valida��o
         * @var array
         */
        public $validate = array(
            'descricao' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Informe a descri��o',
                    'required' => true,
                    'last' => true,
                ),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Descri��o deve ser �nico',
                ),
            ),
            'slug' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Informe o slug',
                    'required' => true,
                    'last' => true,
                ),
                'er' => array(
                    'rule' => '/^[\w-]+$/',
                    'message' => 'V�lido somente letras e/ou h�fen',
                    'last' => true,
                ),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Slug deve ser �nico',
                ),
            ),
        );

        /**
         * Has many
         * @var array
         */
        public $hasMany = array(
            'Tabela' => array(
                'className' => 'Leal.Tabela',
            ),
        );

        /**
         * Retorna a lista de �rg�os que possuem tabelas ativas
         * @return array
         */
        public function findListTabelaAtiva() {
            $tabelas = $this->Tabela->findAllAtiva();
            $orgao_id = Hash::extract($tabelas, '{n}.Tabela.orgao_id');
            $conditions = array('id' => $orgao_id);
            return $this->find('list', compact('conditions'));
        }

    }
    