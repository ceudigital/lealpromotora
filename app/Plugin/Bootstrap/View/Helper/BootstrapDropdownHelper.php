<?php

	 App::uses('Helper', 'View');

	 /**
	  * 
	  * Céu Digital - http://www.ceudigital.com.br
	  * Limites?!
	  * 
	  * BootstrapDropdownHelper
	  *
	  * @author Andre Araujo
	  */
	 class BootstrapDropdownHelper extends AppHelper {

		 /**
		  * Lista de itens do dropdown
		  * @var array
		  */
		 private $dropdownItens = array();

		 public function dropdown($buttonLabel, $buttonOptions = array()) {
			 $dropdownId = sprintf('bootstrapDropdown%s', mktime());
			 $buttonOptions = $this->getButtonOptions($buttonOptions, $dropdownId);
			 $buttonLabel = sprintf('%s <span class="caret"></span>', $buttonLabel);
			 $dropdownItens = $this->dropdownItens;
			 return $this->_View->element('Bootstrap.dropdown', compact('buttonLabel', 'dropdownId', 'buttonOptions', 'dropdownItens'));
		 }

		 public function resetItens() {
			 $this->dropdownItens = array();
		 }

		 public function addHeader($label) {
			 $this->dropdownItens[] = sprintf('<li class="dropdown-header">%s</li>', $label);
		 }

		 public function addItem($item, $enabled = true) {
			 $format = $enabled ? '<li>%s</li>' : '<li class="disabled">%s</li>';
			 $this->dropdownItens[] = sprintf($format, $item);
		 }

		 public function addDivider() {
			 $this->dropdownItens[] = '<li role="separator" class="divider"></li>';
		 }

		 private function getButtonOptions($buttonOptions, $dropdownId) {
			 $buttonOptionsDefault = array(
				  'class' => 'btn btn-default dropdown-toggle',
				  'type' => 'button',
				  'id' => $dropdownId,
				  'data-toggle' => 'dropdown',
				  'aria-haspopup' => 'true',
				  'aria-expanded' => 'true',
			 );
			 if (isset($buttonOptions['class'])) {
				 $buttonOptionsDefault = $this->addClass($buttonOptionsDefault, $buttonOptions['class']);
				 unset($buttonOptions['class']);
			 }
			 return array_merge($buttonOptionsDefault, $buttonOptions);
		 }

	 }
	 