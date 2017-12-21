<?php

    /**
     * Description of UploadInvalidMimeException
     *
     * @author Andre Araujo
     */
    class UploadInvalidFiletypeException extends CakeException {

        public function __construct() {
            parent::__construct('Tipo de arquivo inválido');
        }

    }
    