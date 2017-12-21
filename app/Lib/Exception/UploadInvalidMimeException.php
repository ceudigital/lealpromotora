<?php

    /**
     * Description of UploadInvalidMimeException
     *
     * @author Andre Araujo
     */
    class UploadInvalidMimeException extends CakeException {

        public function __construct() {
            parent::__construct('Tipo de arquivo inválido');
        }

    }
    