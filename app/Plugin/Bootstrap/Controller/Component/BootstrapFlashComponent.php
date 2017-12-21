<?php

	 /**
	  * Flash Component
	  * @see http://getbootstrap.com/components/#alerts
	  */
	 App::uses('Component', 'Controller');

	 class BootstrapFlashComponent extends Component {

		 /**
		  * Lista de componentys
		  * @var array
		  */
		 public $components = array('Session');

		 /**
		  * success
		  * @param string $message
		  */
		 public function success($message) {
			 $this->Session->setFlash($message, 'Bootstrap.flash', array('class' => 'success'), 'success');
		 }

		 /**
		  * info
		  * @param string $message
		  */
		 public function info($message) {
			 $this->Session->setFlash($message, 'Bootstrap.flash', array('class' => 'info'), 'info');
		 }

		 /**
		  * error
		  * @param string $message
		  */
		 public function error($message) {
			 $this->Session->setFlash($message, 'Bootstrap.flash', array('class' => 'danger'), 'error');
		 }

		 /**
		  * warning
		  * @param string $message
		  */
		 public function warning($message) {
			 $this->Session->setFlash($message, 'Bootstrap.flash', array('class' => 'warning'), 'warning');
		 }

	 }
	 