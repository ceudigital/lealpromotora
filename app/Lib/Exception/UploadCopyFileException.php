<?php

    /**
     * Description of UploadCopyFileException
     *
     * @author Andre Araujo
     */
    class UploadCopyFileException extends CakeException {

        public function __construct() {
            parent::__construct('Ocorreu um erro ao copiar o arquivo');
        }

    }
    