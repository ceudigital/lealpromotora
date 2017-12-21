<?php

    /**
     * Helper para jQuery Mask Plugin v1.14.8
     *
     * @author Andre Araujo
     */
    class FieldMaskHelper extends AppHelper {

        /**
         * Lista de helpers
         * @var array
         */
        public $helpers = array('Html');

        /**
         * M�scara CEP
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o c�digo js, false para incluir no cabe�alho do documento
         * @return string C�digo JS
         */
        public function cep($selector, $inline = false) {
            return $this->mask($selector, '00000-000', $inline);
        }

        /**
         * M�scara CPF
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o c�digo js, false para incluir no cabe�alho do documento
         * @return string C�digo JS
         */
        public function cpf($selector, $inline = false) {
            return $this->mask($selector, '000.000.000-00', $inline);
        }

        /**
         * M�scara data dd/mm/aaaa
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o c�digo js, false para incluir no cabe�alho do documento
         * @return string C�digo JS
         */
        public function data($selector, $inline = false) {
            return $this->mask($selector, '00/00/0000', $inline);
        }

        /**
         * M�scara d�gito verificador (n?mero inteiro ou x)
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o c�digo js, false para incluir no cabe�alho do documento
         * @return string C�digo JS
         */
        public function digitoVerificador($selector, $inline = false) {
            $js = <<<JS
    $(function(){
        $('$selector').mask('Z#', {
            translation: {
              'Z': {
                pattern: /[\dxX]/, optional: false
              }
            }
        });
    });
JS;
            return $this->Html->scriptBlock($js, compact('inline'));
        }

        /**
         * M�scara n?meros inteiros
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o c�digo js, false para incluir no cabe�alho do documento
         * @return string C�digo JS
         */
        public function numeroInteiro($selector, $inline = false) {
            return $this->mask($selector, '0#', $inline);
        }

        /**
         * M�scara telefone 8 d�gitos
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o c�digo js, false para incluir no cabe�alho do documento
         * @return string C�digo JS
         */
        public function telefone($selector, $inline = false) {
            return $this->mask($selector, '(00) 0000-0000', $inline);
        }

        /**
         * M�scara telefone 9 d�gitos
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o c�digo js, false para incluir no cabe�alho do documento
         * @return string C�digo JS
         */
        public function telefone9($selector, $inline = false) {
            $js = <<<JS
    $(function(){
        $('$selector').focusout(function(){
            var phone, element;
            element = $(this);
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if(phone.length > 10) {
                element.mask('(00) 00000-0009');
            } else {
                element.mask('(00) 0000-00009');
            }
        }).trigger('focusout');
    });
JS;
            return $this->Html->scriptBlock($js, compact('inline'));
        }

        /**
         * Fun??o template para m?scaras
         * @param string $selector Seletor jQuery
         * @param string $mask M�scara para aplicar no campo
         * @param booelan $inline True retorna o c�digo js, false para incluir no cabe�alho do documento
         * @return string C�digo JS
         */
        private function mask($selector, $mask, $inline) {
            $js = <<<JS
    $(function(){ $('$selector').mask('$mask'); });
JS;
            return $this->Html->scriptBlock($js, compact('inline'));
        }

    }
    