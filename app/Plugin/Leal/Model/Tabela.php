<?php

    /**
     * Tabela
     *
     * @author Andre Araujo
     * 
     * @property Orgao $Orgao
     * @property Coeficiente $Coeficiente 
     */
    class Tabela extends LealAppModel {

        /**
         * Nome da tabela
         * @var string
         */
        public $useTable = 'tabela';

        /**
         * Regras de valida��o
         * @var array
         */
        public $validate = array(
            'orgao_id' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Informe o �rg�o',
                    'required' => true,
                )
            ),
            'vigencia_inicio' => array(
                'date' => array(
                    'rule' => 'date',
                    'message' => 'Informe uma data v�lida',
                    'required' => true,
                ),
            ),
            'vigencia_fim' => array(
                'date' => array(
                    'rule' => 'date',
                    'message' => 'Informe uma data v�lida',
                    'required' => true,
                    'allowEmpty' => true,
                ),
            ),
        );

        /**
         * Belongs to
         * @var array
         */
        public $belongsTo = array(
            'Orgao' => array(
                'className' => 'Leal.Orgao',
            ),
        );

        /**
         * Has many
         * @var array
         */
        public $hasMany = array(
            'Coeficiente' => array(
                'className' => 'Leal.Coeficiente',
            ),
        );

        /**
         * Rela��o de tabelas ativas
         * @return array
         */
        public function findAllAtiva() {
            $conditions = array(
                'vigencia_inicio <= CURDATE()',
                'OR' => array(
                    'vigencia_fim >= CURDATE()',
                    'vigencia_fim' => null,
                ),
            );
            return $this->find('all', compact('conditions'));
        }

        /**
         * Retorna a tabela ativa para o �rg�o informado
         * @param int $orgao_id ID do �rg�o
         * @return array
         */
        public function findAtivaByOrgao($orgao_id) {
            $this->Behaviors->load('Containable');
            $contain = array(
                'Coeficiente' => array(
                    'order' => 'Coeficiente.prazo ASC',
                ),
            );
            $conditions = array(
                'orgao_id' => $orgao_id,
                'vigencia_inicio <= CURDATE()',
                'OR' => array(
                    'vigencia_fim >= CURDATE()',
                    'vigencia_fim' => null,
                ),
            );

            return $this->find('first', compact('contain', 'conditions'));
        }

        /**
         * Simula��o de empr�stimo para tabelas do �rg�o e valor informados
         * @param int $orgao_id ID do �rg�o
         * @param float $valor Valor solicitado
         * @return array Dados das tabelas com a simula��o de empr�stimo a partir do valor informado
         */
        public function simular($orgao_id, $valor) {
            $tabela = $this->findAtivaByOrgao($orgao_id);
            foreach ($tabela['Coeficiente'] as &$coeficiente) {
                $coeficiente['parcela'] = $this->Coeficiente->calcularParcela($coeficiente['id'], $valor);
            }
            return $tabela;
        }

        /**
         * Retorna lista indexada pelo ID e com exibi��o no formato ORGAO - VI - VF
         * @return array
         */
        public function findList() {
            $this->virtualFields['descricao'] = 'CONCAT(Orgao.descricao, " | ", DATE_FORMAT(Tabela.vigencia_inicio, "%d/%m/%Y"), " - ", IFNULL(DATE_FORMAT(Tabela.vigencia_fim, "%d/%m/%Y"), "atual"))';
            $joins = array(
                array(
                    'table' => 'orgao',
                    'alias' => 'Orgao',
                    'type' => 'INNER',
                    'conditions' => 'Orgao.id = Tabela.orgao_id',
                ),
            );
            $fields = array('Tabela.id', 'Tabela.descricao');
            $list = $this->find('list', compact('joins', 'fields'));
            unset($this->virtualFields['descricao']);
            return $list;
        }

        /**
         * Carrega todas as associa��es via Containable
         */
        public function loadContains() {
            $this->Behaviors->load('Containable');
            $this->contain(array(
                'Orgao',
            ));
        }

    }
    