<?php

    App::uses('CakeNumber', 'Utility');
    App::uses('CakeTime', 'Utility');

    /**
     * Description of CoeficienteHelper
     *
     * @author Andre Araujo
     * 
     * @property HtmlHelper $Html
     */
    class CoeficienteHelper extends AppHelper {

        /**
         * Lista de helpers utilizados neste helper
         * @var array
         */
        public $helpers = array('Html');

        /**
         * Órgão
         * @param array $coeficiente Dados do coeficiente
         * @return string HTML
         */
        public function orgao($coeficiente) {
            $url = array(
                'controller' => 'orgao',
                'action' => 'edit',
                $coeficiente['Tabela']['Orgao']['id'],
            );
            return $this->Html->link($coeficiente['Tabela']['Orgao']['descricao'], $url);
        }

        /**
         * Tabela
         * @param array $coeficiente Dados do coeficiente
         * @return string HTML
         */
        public function tabela($coeficiente) {
            $inicio = CakeTime::format($coeficiente['Tabela']['vigencia_inicio'], '%d/%m/%Y');
            $fim = CakeTime::format($coeficiente['Tabela']['vigencia_fim'], '%d/%m/%Y', 'atual');
            $label = sprintf('%s - %s', $inicio, $fim);
            $url = array(
                'controller' => 'tabela',
                'action' => 'edit',
                $coeficiente['Tabela']['id'],
            );
            return $this->Html->link($label, $url);
        }

        /**
         * Prazo
         * @param array $coeficiente Dados do coeficiente
         * @return string HTML
         */
        public function prazo($coeficiente) {
            return $coeficiente['Coeficiente']['prazo'];
        }

        /**
         * Prazo
         * @param array $coeficiente Dados do coeficiente
         * @return string HTML
         */
        public function coeficiente($coeficiente) {
            $options = array(
                'before' => '',
                'places' => 5,
                'thousands' => '.',
                'decimals' => ','
            );
            return CakeNumber::format($coeficiente['Coeficiente']['coeficiente'], $options);
        }

        /**
         * Botão para CoeficienteController::edit
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
         * Botão para CoeficienteController::add
         * @param array $coeficiente Dados do coeficiente
         * @return string HTML
         */
        public function editar($coeficiente) {
            $url = array(
                'action' => 'edit',
                $coeficiente['Coeficiente']['id'],
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
    