<?php

    /**
     * Flash Component
     */
    App::uses('Component', 'Controller');

    class PNotifyFlashComponent extends Component {

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
            $this->Session->setFlash($message, 'Jquery.pnotify', array('type' => 'success'), 'success');
        }

        /**
         * info
         * @param string $message
         */
        public function info($message) {
            $this->Session->setFlash($message, 'Jquery.pnotify', array('type' => 'info'), 'info');
        }

        /**
         * error
         * @param string $message
         */
        public function error($message) {
            $this->Session->setFlash($message, 'Jquery.pnotify', array('type' => 'error'), 'error');
        }

        /**
         * warning
         * @param string $message
         */
        public function warning($message) {
            $this->Session->setFlash($message, 'Jquery.pnotify', array('type' => 'warning'), 'warning');
        }

    }
    