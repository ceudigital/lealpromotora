<?php

	 /**
	  * 
	  * Céu Digital - http://www.ceudigital.com.br
	  * Limites?!
	  * 
	  * JqueryHelper
	  *
	  * @author Andre Araujo
	  */
	 class JqueryHelper extends AppHelper {

		 /**
		  * Converte um array associativo de opções (chave => valor) para trecho
		  * de javascript. Para trechos de código javascript, para que não sejam
		  * gerados como string envolver com chaves, exemplo: {trechoJavaScript();}
		  * 
		  * @param array $options Array associativo de opções
		  * @param array $default_options Array associativo com opções padrão, que podem ser 
		  * @return string Trecho javascript
		  */
		 public function getOptionsString($options, array $default_options = array(), array $required_options = array()) {
			 $options = array_merge(array_merge($default_options, $options), $required_options);
			 $temp = array();
			 foreach ($options as $option => $value) {
				 switch (true) {
					 case is_array($value):
						 $value = $this->getOptionsString($value);
						 $format = "%s: {%s}";
						 break;
					 case is_numeric($value):
						 $format = "%s: %d";
						 break;
					 case is_bool($value):
						 $value = $value ? 'true' : 'false';
						 $format = "%s: %s";
						 break;
					 case preg_match('/^{(.+)}$/s', $value, $matches):
						 $value = $matches[1];
						 $format = "%s: %s";
						 break;
					 default:
						 $format = "%s: '%s'";
				 }
				 $temp[] = sprintf($format, $option, $value);
			 }
			 return implode(', ', $temp);
		 }

	 }
	 