<?php

	 /**
	  * 
	  * Céu Digital - http://www.ceudigital.com.br
	  * Limites?!
	  * 
	  * AdminItemActionHelper
	  *
	  * @author Andre Araujo
	  * 
	  * @property HtmlHelper $Html
	  */
	 abstract class AdminItemActionHelper extends AppHelper {

		 /**
		  * Lista de helpers
		  * @var array
		  */
		 public $helpers = array('Html');

		 /**
		  * Exibir os botões para um item
		  * @param array $item Array com dados do model
		  * @return string HTML
		  */
		 public function show($item, $methods = array()) {
			 $html = array();
			 if (empty($methods)) {
				 foreach (get_class_methods(get_class($this)) as $method) {
					 if (preg_match('/button_(?<action>\w+)/', $method, $matches)) {
						 $methods[] = $matches['action'];
					 }
				 }
			 }
			 foreach ($methods as $method) {
				 $method = sprintf('button_%s', $method);
				 $html[] = $this->$method($item);
			 }
			 return implode(' ', $html);
		 }

		 /**
		  * 
		  * @param type $label
		  * @param type $url
		  * @param type $options
		  * @param type $enabled
		  * @param type $confirm
		  */
		 public function button($label, $url, $options = array(), $enabled = true, $confirm = null) {
			 $options = $this->addClass($options, 'btn btn-white btn-xs');
			 if ($enabled) {
				 $html = $this->Html->link($label, $url, $options, $confirm);
			 } else {
				 $options = $this->addClass($options, 'disabled');
				 $html = $this->Html->tag('span', $label, $options);
			 }
			 return $html;
		 }

	 }
	 