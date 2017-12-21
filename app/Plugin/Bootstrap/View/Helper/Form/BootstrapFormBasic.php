<?php

	 App::uses('IBootstrapForm', 'Bootstrap.View/Helper/Form');

	 class BootstrapFormBasic implements IBootstrapForm {

		 /**
		  * @return array Array com as opções para inicialização do form
		  */
		 public function getFormOptions() {
			 return array(
				  'role' => 'form',
				  'inputDefaults' => array(
						'div' => array(
							 'class' => 'form-group'
						),
						'label' => array(
							 'class' => 'control-label'
						),
						'class' => 'form-control',
						'error' => array(
							 'attributes' => array(
								  'wrap' => 'span',
								  'class' => 'text-danger small'
							 )
						),
				  )
			 );
		 }

		 /**
		  * Aplica as  alterações necessárias para formatação de campos tipo checkbox
		  * @param string $fieldName Nome do campo
		  * @param array $options Array de opções do campo
		  */
		 public function formatCheckbox($fieldName, $options) {
			 //Checkbox
			 if (isset($options['type']) && $options['type'] == 'checkbox') {
				 $label = isset($options['label']['text']) ? $options['label']['text'] : Inflector::humanize($fieldName);
				 $options['div'] = 'checkbox';
				 $options['class'] = null;
				 $options['label'] = false;
				 $options['before'] = '<label>';
				 $options['after'] = sprintf('%s </label>', $label);
				 $options['format'] = array('before', 'label', 'between', 'input', 'after', 'error');
			 }
			 return $options;
		 }

		 public function formatRadio($fieldName, $options) {
			 //Checkbox
			 if (isset($options['type']) && $options['type'] == 'radio') {
				 $options['div'] = 'form-group radio';
			 }
			 return $options;
		 }

		 /**
		  * Aplica as  alterações necessárias para formatação de elementos button
		  * @param string $html
		  */
		 public function formatButton($html) {
			 return $html;
		 }

		 /**
		  * Aplica as  alterações necessárias para formatação de elementos submit
		  * @param string $html
		  */
		 public function formatSubmit($caption, $options) {
			 $options['div'] = false;
			 return $options;
		 }

	 }
	 