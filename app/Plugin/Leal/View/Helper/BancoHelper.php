<?php

    /**
     * Description of BancoHelper
     *
     * @author Andre Araujo
     * 
     * @property HtmlHelper $Html
     */
    class BancoHelper extends AppHelper {

        /**
         * Lista de helpers utilizados neste helper
         * @var array
         */
        public $helpers = array('Html');

        /**
         * Descrição
         * @param array $banco Dados do banco
         * @return string HTML
         */
        public function descricao($banco) {
            return $banco['Banco']['descricao'];
        }

        /**
         * Código
         * @param array $baco Dados do banco
         * @return string HTML
         */
        public function codigo($baco) {
            return $baco['Banco']['codigo'];
        }

        /**
         * Botão para BancoController::edit
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
         * Botão para BancoController::add
         * @param array $banco Dados do banco
         * @return string HTML
         */
        public function editar($banco) {
            $url = array(
                'action' => 'edit',
                $banco['Banco']['id'],
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
    