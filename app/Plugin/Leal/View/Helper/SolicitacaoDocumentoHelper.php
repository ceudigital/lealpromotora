<?php

    /**
     * Description of SolicitacaoDocumentoHelper
     *
     * @author Andre Araujo
     */
    class SolicitacaoDocumentoHelper extends AppHelper {

        /**
         * Lista de nomes de helpers utilizados neste controller
         * @var array
         */
        public $helpers = array('Html');

        public function listaDocumentos($uuid, $solicitacaoTipoDocumentos) {
            $html = array();
            foreach ($solicitacaoTipoDocumentos as $solicitacaoTipoDocumento) {
                $html[] = $this->solicitacaoDocumento($uuid, $solicitacaoTipoDocumento);
            }
            return $this->Html->nestedList($html, array('style' => 'list-style-type:none;'));
        }

        private function solicitacaoDocumento($uuid, $solicitacaoTipoDocumento) {
            $descricao = $solicitacaoTipoDocumento['SolicitacaoTipoDocumento']['descricao'];
            $confirmado = isset($solicitacaoTipoDocumento['SolicitacaoDocumento'][0]['confirmado']) && $solicitacaoTipoDocumento['SolicitacaoDocumento'][0]['confirmado'];
            $url = array(
                'plugin' => 'leal',
                'controller' => 'solicitacao_documento',
                'action' => 'add',
                'uuid' => $uuid,
                $solicitacaoTipoDocumento['SolicitacaoTipoDocumento']['id'],
            );
            if ($confirmado) {
                $icon = $this->Html->tag('i', '', array('class' => 'fa fa-check-circle', 'style' => 'color:#0c0'));
                $link = $this->Html->link('Substituir', $url);
            } else {
                $icon = $this->Html->tag('i', '', array('class' => 'fa fa-exclamation-circle', 'style' => 'color:#c00'));
                $link = $this->Html->link('Fotografar documento', $url);
            }
            return sprintf('%s <strong>%s</strong> %s', $icon, $descricao, $link);
        }

    }
    