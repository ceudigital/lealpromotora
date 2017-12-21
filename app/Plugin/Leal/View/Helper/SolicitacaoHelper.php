<?php

    App::uses('CakeNumber', 'Utility');

    /**
     * Description of SolicitacaoHelper
     *
     * @author Andre Araujo
     * 
     * @property AdminWidgetHelper $AdminWidget
     * @property BlueimpGalleryHelper $BlueimpGallery
     * @property FormHelper $Form
     * @property HtmlHelper $Html
     *
     */
    class SolicitacaoHelper extends AppHelper {

        /**
         * Lista de helpers utilizados neste helper
         * @var array
         */
        public $helpers = array(
            'Admin.AdminWidget',
            'BlueimpGallery.BlueimpGallery',
            'Form',
            'Html',
        );

        /**
         * ID da solicitação
         * @param array $solicitacao Dados da solicitação
         * @return string HTML
         */
        public function id($solicitacao) {
            return sprintf('#%05d', $solicitacao['Solicitacao']['id']);
        }

        /**
         * Dados do solicitante
         * @param array $solicitacao Dados da solicitação
         * @return string HTML
         */
        public function solicitante($solicitacao) {
            $nome = $solicitacao['Solicitacao']['nome'];
            $email = $solicitacao['Solicitacao']['email'];
            $html = <<<HTML
    <strong>$nome</strong><br />
    <small><a href="mailto:$email">$email</small>
HTML;
            return $html;
        }

        /**
         * Dados do convênio
         * @param array $solicitacao Dados da solicitação
         * @return string HTML
         */
        public function convenio($solicitacao) {
            return $solicitacao['Coeficiente']['Tabela']['Orgao']['descricao'];
        }

        /**
         * Dados do convênio
         * @param array $solicitacao Dados da solicitação
         * @return string HTML
         */
        public function valor($solicitacao) {
            $prazo = (int) $solicitacao['Coeficiente']['prazo'];
            $coeficiente = (float) $solicitacao['Coeficiente']['coeficiente'];
            $valor = CakeNumber::currency($solicitacao['Solicitacao']['valor'], 'BRL');
            $parcela = CakeNumber::currency(($coeficiente * $solicitacao['Solicitacao']['valor']), 'BRL');
            $html = <<<HTML
    <strong>$valor</strong><br />
    <small>{$prazo} x {$parcela}</small>
HTML;
            return $html;
        }

        /**
         * Data de criação da solicitação
         * @param array $solicitacao Dados da solicitação
         * @return string HTML
         */
        public function data($solicitacao) {
            $created = $solicitacao['Solicitacao']['created'];
            $format = CakeTime::isToday($created) ? 'Hoje às %H:%M' : '%d/%m/%Y às %H:%M';
            return CakeTime::format($created, $format, '-');
        }

        /**
         * Galeria com as imagens de documentos
         * @param array $solicitacao
         * @return string HTML
         */
        public function documentos($solicitacao) {
            $images = array();
            if ($solicitacao['DocumentoFrente']['confirmado']) {
                $images[] = array(
                    'image' => sprintf('/img/SolicitacaoDocumento/%s', $solicitacao['DocumentoFrente']['arquivo']),
                    'thumb' => sprintf('SolicitacaoDocumento/thumb_%s', $solicitacao['DocumentoFrente']['arquivo']),
                    'title' => $solicitacao['DocumentoFrente']['SolicitacaoTipoDocumento']['descricao'],
                );
            }
            if ($solicitacao['DocumentoVerso']['confirmado']) {
                $images[] = array(
                    'image' => sprintf('/img/SolicitacaoDocumento/%s', $solicitacao['DocumentoVerso']['arquivo']),
                    'thumb' => sprintf('SolicitacaoDocumento/thumb_%s', $solicitacao['DocumentoVerso']['arquivo']),
                    'title' => $solicitacao['DocumentoVerso']['SolicitacaoTipoDocumento']['descricao'],
                );
            }
            if ($solicitacao['DocumentoSelfie']['confirmado']) {
                $images[] = array(
                    'image' => sprintf('/img/SolicitacaoDocumento/%s', $solicitacao['DocumentoSelfie']['arquivo']),
                    'thumb' => sprintf('SolicitacaoDocumento/thumb_%s', $solicitacao['DocumentoSelfie']['arquivo']),
                    'title' => $solicitacao['DocumentoSelfie']['SolicitacaoTipoDocumento']['descricao'],
                );
            }
            if ($solicitacao['DocumentoContracheque']['confirmado']) {
                $images[] = array(
                    'image' => sprintf('/img/SolicitacaoDocumento/%s', $solicitacao['DocumentoContracheque']['arquivo']),
                    'thumb' => sprintf('SolicitacaoDocumento/thumb_%s', $solicitacao['DocumentoContracheque']['arquivo']),
                    'title' => $solicitacao['DocumentoContracheque']['SolicitacaoTipoDocumento']['descricao'],
                );
            }
            if ($solicitacao['DocumentoComprovanteResidencia']['confirmado']) {
                $images[] = array(
                    'image' => sprintf('/img/SolicitacaoDocumento/%s', $solicitacao['DocumentoComprovanteResidencia']['arquivo']),
                    'thumb' => sprintf('SolicitacaoDocumento/thumb_%s', $solicitacao['DocumentoComprovanteResidencia']['arquivo']),
                    'title' => $solicitacao['DocumentoComprovanteResidencia']['SolicitacaoTipoDocumento']['descricao'],
                );
            }
            return $this->BlueimpGallery->create($images);
        }

        /**
         * Progresso do preenchimento
         * @param array $solicitacao Dados da solicitação
         * @return string HTML
         */
        public function progressoPreenchimento($solicitacao, $label = 'Progresso %d%%', $size = 'progress-mini') {
            $value = 0;
            $value += $solicitacao['Solicitacao']['etapa_1'];
            $value += $solicitacao['Solicitacao']['etapa_2'];
            $value += $solicitacao['Solicitacao']['etapa_3'];
            $value += $solicitacao['Solicitacao']['etapa_4'];
            return $this->AdminWidget->progressBar($value, 4, $label, $size);
        }

        /**
         * Progresso do preenchimento
         * @param array $solicitacao Dados da solicitação
         * @return string HTML
         */
        public function progressoDocumentos($solicitacao, $label = 'Progresso %d%%', $size = 'progress-mini') {
            $value = 0;
            $value += $solicitacao['DocumentoFrente']['confirmado'] ? 1 : 0;
            $value += $solicitacao['DocumentoVerso']['confirmado'] ? 1 : 0;
            $value += $solicitacao['DocumentoSelfie']['confirmado'] ? 1 : 0;
            $value += $solicitacao['DocumentoContracheque']['confirmado'] ? 1 : 0;
            $value += $solicitacao['DocumentoComprovanteResidencia']['confirmado'] ? 1 : 0;
            return $this->AdminWidget->progressBar($value, 5, $label, $size);
        }

        /**
         * Botão para action SolicitacaoController::view
         * @param array $solicitacao Dados da solicitação
         * @return string HTML
         */
        public function ver($solicitacao) {
            $url = array(
                'action' => 'view',
                $solicitacao['Solicitacao']['id'],
            );
            $options = array(
                'icon' => 'fa fa-folder',
                'class' => 'btn btn-white btn-sm',
            );
            return $this->Html->link('Ver', $url, $options);
        }

        /**
         * Extrai o valor de um campo dado um path
         * @param array $solicitacao Dados da solicitação
         * @param string $path Path compativel com Hash::extract
         * @return mixed Valor correspondente ao path informado
         */
        public function campo($solicitacao, $path) {
            $extract = Hash::extract($solicitacao, $path);
            return array_shift($extract);
        }

    }
    