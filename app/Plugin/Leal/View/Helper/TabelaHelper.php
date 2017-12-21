<?php

    App::uses('CakeTime', 'Utility');

    /**
     * Description of TabelaHelper
     *
     * @author Andre Araujo
     * 
     * @property HtmlHelper $Html
     */
    class TabelaHelper extends AppHelper {

        /**
         * Lista de helpers utilizados neste helper
         * @var array
         */
        public $helpers = array(
            'Html',
        );

        /**
         * Descrição
         * @param array $tabela Dados da Tabela
         * @return string HTML
         */
        public function orgao($tabela) {
            $url = array(
                'controller' => 'orgao',
                'action' => 'edit',
                $tabela['Orgao']['id'],
            );
            return $this->Html->link($tabela['Orgao']['descricao'], $url);
        }

        /**
         * Código
         * @param array $tabela Dados da Tabela
         * @return string HTML
         */
        public function vigencia($tabela) {
            $inicio = CakeTime::format($tabela['Tabela']['vigencia_inicio'], '%d/%m/%Y');
            $fim = CakeTime::format($tabela['Tabela']['vigencia_fim'], '%d/%m/%Y', 'atual');
            return sprintf('%s - %s', $inicio, $fim);
        }

        /**
         * Botão para  TabelaController::edit
         * @param array $tabela Dados da Tabela
         * @return string HTML
         */
        public function incluir() {
            $url = array('action' => 'add');
            $options = array(
                'icon' => 'fa fa-plus-circle',
                'class' => 'btn btn-primary btn-sm',
                'title' => 'Incluir',
                'data-toggle' => 'tooltip',
            );
            return $this->Html->link('Incluir', $url, $options);
        }

        /**
         * Botão para  TabelaController::edit
         * @param array $tabela Dados da Tabela
         * @return string HTML
         */
        public function editar($tabela) {
            $url = array(
                'action' => 'edit',
                $tabela['Tabela']['id'],
            );
            $options = array(
                'icon' => 'fa fa-edit',
                'class' => 'btn btn-white btn-sm',
                'title' => 'Editar',
                'data-toggle' => 'tooltip',
            );
            return $this->Html->link('', $url, $options);
        }

    }
    