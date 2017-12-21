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
         * Máscara CEP
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o código js, false para incluir no cabeçalho do documento
         * @return string Código JS
         */
        public function cep($selector, $inline = false) {
            return $this->mask($selector, '00000-000', $inline);
        }

        /**
         * Máscara CPF
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o código js, false para incluir no cabeçalho do documento
         * @return string Código JS
         */
        public function cpf($selector, $inline = false) {
            return $this->mask($selector, '000.000.000-00', $inline);
        }

        /**
         * Máscara data dd/mm/aaaa
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o código js, false para incluir no cabeçalho do documento
         * @return string Código JS
         */
        public function data($selector, $inline = false) {
            return $this->mask($selector, '00/00/0000', $inline);
        }

        /**
         * Máscara dígito verificador (n?mero inteiro ou x)
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o código js, false para incluir no cabeçalho do documento
         * @return string Código JS
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
         * Máscara n?meros inteiros
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o código js, false para incluir no cabeçalho do documento
         * @return string Código JS
         */
        public function numeroInteiro($selector, $inline = false) {
            return $this->mask($selector, '0#', $inline);
        }

        /**
         * Máscara telefone 8 dígitos
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o código js, false para incluir no cabeçalho do documento
         * @return string Código JS
         */
        public function telefone($selector, $inline = false) {
            return $this->mask($selector, '(00) 0000-0000', $inline);
        }

        /**
         * Máscara telefone 9 dígitos
         * @param string $selector Seletor jQuery
         * @param booelan $inline True retorna o código js, false para incluir no cabeçalho do documento
         * @return string Código JS
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
         * @param string $mask Máscara para aplicar no campo
         * @param booelan $inline True retorna o código js, false para incluir no cabeçalho do documento
         * @return string Código JS
         */
        private function mask($selector, $mask, $inline) {
            $js = <<<JS
    $(function(){ $('$selector').mask('$mask'); });
JS;
            return $this->Html->scriptBlock($js, compact('inline'));
        }

    }
    