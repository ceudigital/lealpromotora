<?php

    /**
     * Description of ConfirmacaoHelper 
     * 
     * @author Andre Araujo 
     *  
     * @property HtmlHelper $Html 
     * @property FormHelper $Form 
     * @property NumberHelper $Number 
     *  
     */
    class ConfirmacaoHelper extends AppHelper {

        /**
         * Lista de helpers     
         * @var array     
         */
        public $helpers = array('Form', 'Html', 'Number');

        /**
         * Aceite dos termos de serviço     
         * @return string HTML     
         */
        public function aceiteTermos() {
            $label = 'Aceita nossos termos de serviço?';
            $options = array('div' => 'field radio', 'type' => 'radio', 'legend' => false, 'options' => array('1' => 'Aceito', '0' => 'Não aceito'));
            $text = $this->Form->input('aceite_termos', $options);
            return $this->_render($text, $label);
        }

        /**
         * Exibição de campo data em formato PTBR     
         * @param string $path Path para o campo a ser exibido     
         * @param string $label Rótulo para o campo     
         * @return string HTML     
         */
        public function data($path, $label) {
            $text = $this->_extract($path);
            DateConverter::ptbr($text);
            return $this->_render($text, $label);
        }

        /**
         * Exibição de um campo com valor mapeado em array associativo     
         * @param string $path Path para o campo a ser exibido     
         * @param string $label Rótulo para o campo     
         * @param array $map Array associativo com a valor a ser exibido indexado pelo     
         * valor obtido no path     
         * @return string HTML     
         */
        public function map($path, $label, array $map) {
            $value = $this->_extract($path);
            $text = isset($map[$value]) ? $value : null;
            return $this->_render($text, $label);
        }

        /**
         * Exibição de campo data em formato PTBR     
         * @param string $path Path para o campo a ser exibido     
         * @param string $label Rótulo para o campo     
         * @return string HTML     
         */
        public function monetario($path, $label) {
            $text = $this->Number->currency($this->_extract($path), 'BRL');
            return $this->_render($text, $label);
        }

        /**
         * Exibição do parcelamento (99x R$ 9.999,00)  
         * @return type     
         */
        public function parcelamento() {
            $label = 'Parcelamento';
            $prazo = $this->_extract('Coeficiente.prazo');
            $parcela = $this->Number->currency($this->_extract('Solicitacao.parcela'), 'BRL');
            $text = sprintf('%dx %s', $prazo, $parcela);
            return $this->_render($text, $label);
        }

        /**
         * Termos de serviço     
         */
        public function termosDeServico() {
            $label = 'Termos de serviço';
            $text = $this->_View->element('termos_de_servico');
            return $this->_render($text, $label);
        }

        /**
         * Exibição de campo texto     
         * @param string $path Path para o campo a ser exibido     
         * @param string $label Rótulo para o campo     
         * @return string HTML     
         */
        public function texto($path, $label) {
            $text = $this->_extract($path);
            return $this->_render($text, $label);
        }

        /**
         * Exibição das imagens dos documentos
         * @param string $model Nome do model referente a imagem
         * @param string $label Rótulo para a imagem
         */
        public function imagem($model, $label) {
            $text = $this->Html->tag('span', 'Imagem não enviada!', array('style' => 'color:#c00;'));
            $path = sprintf('%s.arquivo', $model);
            $arquivo = $this->_extract($path, false);
            $file = new File(ROOT . DS . 'img' . DS . 'SolicitacaoDocumento' . DS . $arquivo);
            if ($file->exists()) {
                $text = $this->Html->image(sprintf('SolicitacaoDocumento/%s', $arquivo), array('style' => 'width:440px'));
            }
            return $this->_render($text, $label);
        }

        /**
         * Renderiza o element campo_confirmacao     
         * @param string $text Texto     
         * @param string $label Rótulo do texto     
         * @return string HTML     
         */
        public function _render($text, $label) {
            return $this->_View->element('campo_confirmacao', compact('text', 'label'));
        }

        /**
         * Extrai o valor de um $path a partir do array $this->request->data     
         * @param string $path Path do dado a ser extraído     
         * @return string Valor do campo referente ao path     
         */
        private function _extract($path, $default = '-') {
            $extract = Hash::extract($this->request->data, $path);
            return empty($extract) ? $default : array_shift($extract);
        }

    }
    