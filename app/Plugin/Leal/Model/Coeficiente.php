<?php

    /**
     * Coeficiente
     *
     * @author Andre Araujo
     * 
     * @property Tabela $Tabela
     */
    class Coeficiente extends LealAppModel {

        /**
         * Nome da tabela
         * @var string
         */
        public $useTable = 'coeficiente';

        /**
         * Regras de validação
         * @var array
         */
        public $validate = array(
            'tabela_id' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Informe a tabela',
                    'required' => true,
                )
            ),
            'prazo' => array(
                'naturalNumber' => array(
                    'rule' => 'naturalNumber',
                    'message' => 'Informe um valor inteiro',
                    'required' => true,
                ),
            ),
            'coeficiente' => array(
                'numeric' => array(
                    'rule' => 'numeric',
                    'message' => 'Informe um valor numérico',
                    'required' => true,
                ),
            ),
        );

        /**
         * Belongs to
         * @var array
         */
        public $belongsTo = array(
            'Tabela' => array(
                'className' => 'Leal.Tabela',
            ),
        );

        /**
         * Cálculo do valor da parcela dado um coeficiente e um valor
         * @param int $id ID do coeficiente
         * @param float $valor Valor solicitado
         * @return float Valor da parcela
         */
        public function calcularParcela($id, $valor) {
            $parcela = null;
            $coeficiente = $this->findById($id);
            if ($coeficiente) {
                $parcela = $coeficiente['Coeficiente']['coeficiente'] * $valor;
            }
            return $parcela;
        }

        /**
         * Carrega todas as associações via Containable
         */
        public function loadContains() {
            $this->Behaviors->load('Containable');
            $this->contain(array(
                'Tabela' => array(
                    'Orgao',
                ),
            ));
        }

    }
    