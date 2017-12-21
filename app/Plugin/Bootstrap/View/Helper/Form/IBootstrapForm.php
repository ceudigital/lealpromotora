<?php

	 interface IBootstrapForm {

		 /**
		  * @return array Array com as op��es para inicializa��o do form
		  */
		 public function getFormOptions();

		 /**
		  * Aplica as  altera��es necess�rias para formata��o de campos tipo checkbox
		  * @param string $fieldName Nome do campo
		  * @param array $options Array de op��es do campo
		  */
		 public function formatCheckbox($fieldName, $options);

		 /**
		  * Aplica as  altera��es necess�rias para formata��o de campos tipo radio
		  * @param string $fieldName Nome do campo
		  * @param array $options Array de op��es do campo
		  */
		 public function formatRadio($fieldName, $options);

		 /**
		  * Aplica as  altera��es necess�rias para formata��o de elementos button
		  * @param string $html
		  */
		 public function formatButton($html);

		 /**
		  * Aplica as  altera��es necess�rias para formata��o de elementos submit
		  * @param string $html
		  */
		 public function formatSubmit($caption, $options);
	 }
	 