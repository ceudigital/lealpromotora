<?php

	 App::uses('HtmlHelper', 'View/Helper');

	 class BootstrapHtmlHelper extends HtmlHelper {

		 /**
		  * Button Group
		  * <div class="btn-group" role="group" aria-label="...">
		  * @see http://getbootstrap.com/components/#btn-groups-single
		  */
		 public function buttonGroup($buttons = array(), $options = array()) {
			 $defaults = array(
				  'class' => 'btn-group',
				  'role' => 'group'
			 );
			 $options = array_merge_recursive($options, $defaults);
			 $html = $this->tag('div', null, $options);
			 foreach ($buttons as $button) {
				 $html .= $button;
			 }
			 $html .= $this->tag('/div');
			 return $html;
		 }

		 /**
		  * link
		  * @param type $title
		  * @param type $url
		  * @param type $options
		  * @param type $confirmMessage
		  * @return type
		  */
		 public function link($title, $url = null, $options = array(), $confirmMessage = false) {
			 $this->icon($title, $options);			 
			 return parent::link($title, $url, $options, $confirmMessage);
		 }

		 /**
		  * tag
		  * @param type $name
		  * @param type $text
		  * @param type $options
		  * @return type
		  */
		 public function tag($name, $text = null, $options = array()) {
			 $this->icon($text, $options);
			 return parent::tag($name, $text, $options);
		 }

		 /**
		  * Inclui a opção "icon"
		  * @param type $text
		  * @param boolean $options
		  */
		 private function icon(&$text, &$options) {
			 if (isset($options['icon'])) {
				 $text = sprintf('<i class="%s"></i> %s', $options['icon'], $text);
				 $options['escape'] = false;
				 unset($options['icon']);
			 }
		 }

	 }
	 