<?php

	 App::uses('Helper', 'View');

	 class BootstrapLayoutHelper extends AppHelper {

		 /**
		  * Lista de helpers
		  * @var array
		  */
		 public $helpers = array(
			  'Html',
		 );

		 private function column($name, $column_size) {
			 $html = null;
			 if ($this->_View->fetch($name)) {
				 $class = sprintf('col-sm-%d', $column_size);
				 $html = $this->Html->tag('div', $this->_View->fetch($name), compact('class'));
			 }
			 return $html;
		 }

		 public function right($column_size = 3) {
			 return $this->column('right', $column_size);
		 }

		 public function left($column_size = 3) {
			 return $this->column('left', $column_size);
		 }

		 public function content($left_column_size = 3, $right_column_size = 3) {
			 $column_size = 12 - ($this->_View->fetch('left') ? $left_column_size : 0) - ($this->_View->fetch('right') ? $right_column_size : 0);
			 return $this->column('content', $column_size);
		 }

	 }
	 