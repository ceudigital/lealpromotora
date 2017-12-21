<?php

	 class BootstrapFormNotFoundException extends Exception {

		 public function __construct($classname) {
			 parent::__construct(sprintf('Form %s not found', $classname));
		 }

	 }
	 