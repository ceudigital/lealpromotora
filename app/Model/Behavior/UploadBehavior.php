<?php

    App::uses('CakeTime', 'Utility');
    App::uses('Folder', 'Utility');
    App::uses('UploadInvalidMimeException', 'Lib/Exception');
    App::uses('UploadInvalidFiletypeException', 'Lib/Exception');
    App::uses('UploadCopyFileException', 'Lib/Exception');

    /**
     * Description of UploadBehavior
     *
     * @author Andre Araujo
     */
    class UploadBehavior extends ModelBehavior {

        public function setup(Model $Model, $settings = array()) {
            $default = array(
                'folder' => '{ROOT}{DS}files',
                'filename' => '{filename}.{ext}',
                'allowedMime' => array('image/jpeg', 'image/pjpeg', 'image/png'),
                'allowedExt' => array('jpg', 'jpeg', 'png'),
                'thumbnails' => false,
            );
            foreach ($settings as $field => $settings) {
                $this->settings[$Model->alias][$field] = array_merge($default, $settings);
            }
        }

        /**
         * after validate
         * @param Model $Model
         * @return boolean
         */
        public function afterValidate(Model $Model) {
            $result = true;
            foreach ($this->settings[$Model->alias] as $field => $settings) {
                try {
                    $this->processField($Model, $field);
                } catch (CakeException $ex) {
                    $Model->invalidate($field, $ex->getMessage());
                    $result = false;
                    break;
                }
            }
            return $result;
        }

        /**
         * Processamento de um campo (verifica mime, extensão e copia o arquivo)
         * @param Model $Model
         * @param type $field
         * @throws UploadInvalidMimeException
         * @throws UploadInvalidFiletypeException
         * @throws UploadCopyFileException
         */
        public function processField(Model $Model, $field) {
            if (array_key_exists($field, $Model->data[$Model->alias])) {
                if (!$this->checkMime($Model, $field)) {
                    throw new UploadInvalidMimeException();
                }
                if (!$this->checkExt($Model, $field)) {
                    throw new UploadInvalidFiletypeException();
                }
                $filename = $this->copyFile($Model, $field);
                if ($filename === false) {
                    throw new UploadCopyFileException();
                }
                $Model->set($field, $filename);
            }
        }

        /**
         * Copia o arquivo para o diretório destino de acordo com as configurações
         * do campo informado
         * @param Model $Model
         * @param type $field
         * @return string Nome do arquivo gerado
         */
        private function copyFile(Model $Model, $field) {
            $folder = $this->getFolder($Model, $field);
            $filename = $this->getFilename($Model, $field);
            $tmp_name = $Model->data[$Model->alias][$field]['tmp_name'];
            $destination = $folder->pwd() . DS . $filename;
            if (file_exists($destination)) {
                unlink($destination);
            }
            return move_uploaded_file($tmp_name, $destination) ? $filename : false;
        }

        /**
         * Informa se o tipo mime do arquivo enviado está entre os tipos 
         * permitidos para o campo
         * @param Model $Model
         * @param string $field
         * @return booelan
         */
        private function checkMime(Model $Model, $field) {
            $allowedMime = $this->settings[$Model->alias][$field]['allowedMime'];
            return in_array($Model->data[$Model->alias][$field]['type'], $allowedMime);
        }

        /**
         * Informa se o tipo mime do arquivo enviado está entre os tipos 
         * permitidos para o campo
         * @param Model $Model
         * @param string $field
         * @return booelan
         */
        private function checkExt(Model $Model, $field) {
            $allowedExt = $this->settings[$Model->alias][$field]['allowedExt'];
            $pathinfo = pathinfo($Model->data[$Model->alias][$field]['name']);
            return in_array(strtolower($pathinfo['extension']), $allowedExt);
        }

        /**
         * Define o nome do diretório destino do arquivo de acordo com as configurações
         * e cria o diretório caso não exista
         * @param Model $Model
         * @param type $field
         * @return Folder
         */
        private function getFolder(Model $Model, $field) {
            $path = $this->replaceTokens($Model, $field, $this->settings[$Model->alias][$field]['folder']);
            return new Folder($path, true, 0775);
        }

        /**
         * Define o nome do arquivo destino de acordo com as configurações
         * @param Model $Model
         * @param type $field
         * @return string Nome do arquvio
         */
        private function getFilename(Model $Model, $field) {
            $folder = $this->getFolder($Model, $field);
            $filename = $this->replaceTokens($Model, $field, $this->settings[$Model->alias][$field]['filename']);
            while (file_exists($folder->pwd() . DS . $filename)) {
                $pathinfo = pathinfo($filename);
                $filename = sprintf('%s_.%s', $pathinfo['filename'], $pathinfo['extension']);
            }
            return $filename;
        }

        /**
         * Substituição de tokens pelos valores correspondentes para geração 
         * de nome de arquivos e diretórios
         * 
         * {ROOT}     : Caminho para raiz do projeto (definido em index.php)
         * {DS}       : Separador de diretórios
         * {Model}    : Alias do Model
         * {id}       : Valor do id do registro (válido somente para update)
         * {field}    : Nome do campo
         * {ext}      : Extensão do arquivo enviado
         * {timestamp}: Timestamp atual
         * {filename} : Nome original do arquivo
         * 
         * @param Model $Model
         * @param string $field
         * @param string $subject
         * @return string $subject com os tokens substituidos pelos respectivos valores
         */
        private function replaceTokens(Model $Model, $field, $subject) {
            $pathinfo = pathinfo($Model->data[$Model->alias][$field]['name']);
            $alias = $Model->alias;
            $id = $Model->exists() ? $Model->data[$Model->alias][$Model->primaryKey] : null;
            $ext = $pathinfo['extension'];
            $timestamp = CakeTime::serverOffset();
            $filename = Inflector::slug(utf8_encode($pathinfo['filename']));
            $search = array('{ROOT}', '{DS}', '{Model}', '{id}', '{field}', '{ext}', '{timestamp}', '{filename}');
            $replace = array(ROOT, DS, $alias, $id, $field, $ext, $timestamp, $filename);
            return str_replace($search, $replace, $subject);
        }

    }
    