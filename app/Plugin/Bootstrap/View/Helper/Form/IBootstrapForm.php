<?php

	 interface IBootstrapForm {

		 /**
		  * @return array Array com as opчѕes para inicializaчуo do form
		  */
		 public function getFormOptions();

		 /**
		  * Aplica as  alteraчѕes necessсrias para formataчуo de campos tipo checkbox
		  * @param string $fieldName Nome do campo
		  * @param array $options Array de opчѕes do campo
		  */
		 public function formatCheckbox($fieldName, $options);

		 /**
		  * Aplica as  alteraчѕes necessсrias para formataчуo de campos tipo radio
		  * @param string $fieldName Nome do campo
		  * @param array $options Array de opчѕes do campo
		  */
		 public function formatRadio($fieldName, $options);

		 /**
		  * Aplica as  alteraчѕes necessсrias para formataчуo de elementos button
		  * @param string $html
		  */
		 public function formatButton($html);

		 /**
		  * Aplica as  alteraчѕes necessсrias para formataчуo de elementos submit
		  * @param string $html
		  */
		 public function formatSubmit($caption, $options);
	 }
	 