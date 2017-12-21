<?php

    /**
     * Description of OrgaoHelper
     *
     * @author Andre Araujo
     * 
     * @property HtmlHelper $Html
     */
    class OrgaoHelper extends AppHelper {

        /**
         * Lista de helpers utilizados neste helper
         * @var array
         */
        public $helpers = array(
            'Html',
        );

        /**
         * Descrição
         * @param array $orgao Dados da órgão
         * @return string HTML
         */
        public function descricao($orgao) {
            return $orgao['Orgao']['descricao'];
        }

        /**
         * Slug
         * @param array $orgao Dados da órgão
         * @return string HTML
         */
        public function slug($orgao) {
            return $orgao['Orgao']['slug'];
        }

        /**
         * Botão para  SolicitacaoController::edit
         * @param array $orgao Dados da órgão
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
         * Botão para  SolicitacaoController::edit
         * @param array $orgao Dados da órgão
         * @return string HTML
         */
        public function editar($orgao) {
            $url = array(
                'action' => 'edit',
                $orgao['Orgao']['id'],
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
    