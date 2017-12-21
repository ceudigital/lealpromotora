<?php

	 App::uses('Helper', 'View');

	 /**
	  * 
	  * Céu Digital - http://www.ceudigital.com.br
	  * Limites?!
	  * 
	  * BootstrapWizardHelper
	  *
	  * @author Andre Araujo
	  */
	 class BootstrapWizardHelper extends AppHelper {

		 private $item_default = array(
			  'title' => 'undefined',
			  'active' => false,
			  'current' => false,
			  'icon' => 'fa fa-question',
		 );

		 public function wizard($itens) {
			 $wizard_itens_html = array();
			 foreach ($itens as $item) {
				 $item = array_merge($this->item_default, $item);
				 $wizard_itens_html[] = $this->_View->element('Bootstrap.wizard_item', compact('item'));
			 }
			 $wizard_itens_html = implode(' ', $wizard_itens_html);
			 return $this->_View->element('Bootstrap.wizard', compact('wizard_itens_html'));
		 }

	 }
	 