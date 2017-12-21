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
         * Campo de exibição
         * @var string
         */
        public $displayField = 'descricao';

        /**
         * Ordenação padrão
         * @var string
         */
        public $order = 'Orgao.descricao ASC';

        /**
         * Regras de validação
         * @var array
         */
        public $validate = array(
            'descricao' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Informe a descrição',
                    'required' => true,
                    'last' => true,
                ),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Descrição deve ser único',
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
                    'message' => 'Válido somente letras e/ou hífen',
                    'last' => true,
                ),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Slug deve ser único',
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
         * Retorna a lista de órgãos que possuem tabelas ativas
         * @return array
         */
        public function findListTabelaAtiva() {
            $tabelas = $this->Tabela->findAllAtiva();
            $orgao_id = Hash::extract($tabelas, '{n}.Tabela.orgao_id');
            $conditions = array('id' => $orgao_id);
            return $this->find('list', compact('conditions'));
        }

    }
    