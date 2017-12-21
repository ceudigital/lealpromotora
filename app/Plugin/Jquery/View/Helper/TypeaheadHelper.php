<?php

	 /**
	  * TypeaheadHelper
	  * 
	  * @property HtmlHelper $Html
	  */
	 class TypeaheadHelper extends AppHelper {

		 /**
		  * Lista de helpers
		  * @var array
		  */
		 public $helpers = array('Html', 'Jquery.Jquery');

		 /**
		  * Gera uma função javascript que define a inicialização do typeahead
		  * @param string $selector Seletor jquery
		  * @param array $options Array de opções (option => value)
		  * @param array $events Array de eventos (evento => nome do callback)
		  * @param boolean $inline Se true retorna o código gerado, false no head da página atual
		  */
		 public function typeahead($selector, $options = array(), $datasets = array(), $events = array(), $inline = false, $block = 'script') {
			 $default_options = array(
				  'minLength' => 3,
				  'highlight' => true,
				  'hint' => false,
			 );
			 $function = isset($options['function']) ? $options['function'] : 'typeaheadInit';
			 unset($options['function']);
			 $options_string = $this->Jquery->getOptionsString($options, $default_options);
			 $datasets_string = implode(', ', $datasets);
			 $events_string = '';
			 foreach ($events as $event => $callback) {
				 $events_string .= $this->event($selector, $event, $callback);
			 }
			 $js = <<<JS
	function $function(){
		$('$selector').typeahead('destroy');
		$('$selector').typeahead({ $options_string }, $datasets_string);		
		$events_string						
	}
JS;
			 return $this->Html->scriptBlock($js, compact('script', 'block'));
		 }

		 /**
		  * Gera o javascript para definição de um evento do typeahead
		  * @param string $selector Seletor jquery
		  * @param string $event Nome do evento do typeahead, sem o prefixo 'typeahead:'
		  * @param string $callback Nome da função de callback
		  * @return string Código javascript
		  */
		 private function event($selector, $event, $callback) {
			 return sprintf("$(document).on('typeahead:%s', '%s', %s);\r\n", $event, $selector, $callback);
		 }

	 }
	 