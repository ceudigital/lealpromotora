<?php

    /**
     * Description of LealExceptionRenderer
     *
     * @author Andre Araujo
     */
    App::uses('ExceptionRenderer', 'Error');

    class LealExceptionRenderer extends ExceptionRenderer {

        protected function _outputMessage($template) {
            $this->controller->layout = 'Admin.error';
            parent::_outputMessage($template);
        }

    }
    