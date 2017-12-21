<?php

    App::uses('ImageResizer', 'Lib');

    /**
     * Description of ImageResizeBehavior
     *
     * @author Andre Araujo
     */
    class ImageResizeBehavior extends ModelBehavior {

        /**
         * @var ImageResizer
         */
        private $ImageResizer;

        public function setup(Model $Model, $settings = array()) {
            $default = array(
                'folder' => ROOT . DS . 'files',
                'sizes' => array(),
            );
            $default_size = array('width' => null, 'height' => null);
            foreach ($settings as $field => $settings) {
                foreach ($settings['sizes'] as $key => $size) {
                    $settings['sizes'][$key] = array_merge($default_size, $size);
                }
                $this->settings[$Model->alias][$field] = array_merge($default, $settings);
            }
        }

        public function afterSave(Model $model, $created, $options = array()) {
            $this->ImageResizer = new ImageResizer();
            foreach ($this->settings[$model->alias] as $field => $settings) {
                if (isset($model->data[$model->alias][$field])) {
                    $folder = $this->replaceTokens($model, $field, $settings['folder']);
                    $filename = $model->data[$model->alias][$field];
                    foreach ($settings['sizes'] as $prefix => $size) {
                        $prefix = $prefix == 'default' ? null : sprintf('%s_', Inflector::slug($prefix));
                        $input_filename = $folder . DS . $filename;
                        $output_filename = $folder . DS . $prefix . $filename;
                        $this->ImageResizer->setSrc($input_filename);
                        $this->ImageResizer->resize($output_filename, $size['width'], $size['height']);
                    }
                }
            }
        }

        /**
         * Substituição de tokens pelos valores correspondentes para geração 
         * de nome de arquivos e diretórios
         * 
         * {ROOT}     : Caminho para raiz do projeto (definido em index.php)
         * {DS}       : Separador de diretórios
         * {Model}    : Alias do Model
         * {field}    : Nome do campo
         * 
         * @param Model $Model
         * @param string $field
         * @param string $subject
         * @return string $subject com os tokens substituidos pelos respectivos valores
         */
        private function replaceTokens(Model $Model, $field, $subject) {
            $alias = $Model->alias;
            $search = array('{ROOT}', '{DS}', '{Model}', '{field}');
            $replace = array(ROOT, DS, $alias, $field);
            return str_replace($search, $replace, $subject);
        }

    }
    