<?php

    /**
     * Componente Jquery Mask
     * @see http://digitalbush.com/projects/masked-input-plugin
     */
    App::uses('Helper', 'View');

    class MaskedInputHelper extends AppHelper {

        /**
         * Lista de helpers
         * @var array
         */
        public $helpers = array(
            'Html',
        );

        /**
         * Script para aplicar máscara
         * @param string $selector Seletor jquery
         * @param type $mask
         * @param type $inline
         * @return type
         */
        public function mask($selector, $mask, $inline = false) {
            $js = <<<JS
	$(function(){ $('$selector').mask('$mask'); });
JS;
            return $this->Html->scriptBlock($js, compact('inline'));
        }

        /**
         * Máscara CNPJ
         * @param string $selector Seletor jquery
         * @return type
         */
        public function cnpj($selector, $inline = false) {
            return $this->mask($selector, '99.999.999/9999-99', $inline);
        }

        /**
         * Máscara CPF
         * @param string $selector Seletor jquery
         * @return type
         */
        public function cpf($selector, $inline = false) {
            return $this->mask($selector, '999.999.999-99', $inline);
        }

        /**
         * Máscara Data
         * @param string $selector Seletor jquery
         * @return type
         */
        public function data($selector, $inline = false) {
            return $this->mask($selector, '99/99/9999', $inline);
        }

        /**
         * Máscara CPF
         * @param string $selector Seletor jquery
         * @param boolean $inline
         * @return type
         */
        public function telefone($selector, $inline = false) {
            $js = <<<JS
	$(function(){ 
		var mask = $('$selector').val().length > 10 ? '(99) 99999-999?9' : '(99) 9999-9999?9';
		$('$selector').mask(mask).focusout(function (event) {  
			var target, value, element;  
			target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
			value = target.value.replace(/\D/g, '');
			element = $(target);  
			element.unmask();  
			if(value.length > 10) {  
				 element.mask('(99) 99999-999?9');  
			} else {  
				 element.mask('(99) 9999-9999?9');  
			}  
		});
	});
JS;
            return $this->Html->scriptBlock($js, compact('inline'));
        }

        /**
         * Máscara CEP
         * @param string $selector Seletor jquery
         * @param boolean $inline
         * @return type
         */
        public function cep($selector, $inline = false) {
            return $this->mask($selector, '99999-999', $inline);
        }

    }
    