<?php

	 interface IBootstrapForm {

		 /**
		  * @return array Array com as opções para inicialização do form
		  */
		 public function getFormOptions();

		 /**
		  * Aplica as  alterações necessárias para formatação de campos tipo checkbox
		  * @param string $fieldName Nome do campo
		  * @param array $options Array de opções do campo
		  */
		 public function formatCheckbox($fieldName, $options);

		 /**
		  * Aplica as  alterações necessárias para formatação de campos tipo radio
		  * @param string $fieldName Nome do campo
		  * @param array $options Array de opções do campo
		  */
		 public function formatRadio($fieldName, $options);

		 /**
		  * Aplica as  alterações necessárias para formatação de elementos button
		  * @param string $html
		  */
		 public function formatButton($html);

		 /**
		  * Aplica as  alterações necessárias para formatação de elementos submit
		  * @param string $html
		  */
		 public function formatSubmit($caption, $options);
	 }
	 