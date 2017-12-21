<?php

    App::uses('DateFormatter', 'Lib');

    /**
     * Description of UploadBehavior
     *
     * @author Andre Araujo
     */
    class DateFormatBehavior extends ModelBehavior {

        /**
         * Setup
         * @param Model $Model
         * @param array $settings
         */
        public function setup(Model $Model, $settings = array()) {
            $default = array(
                'fields' => array(),
            );
            $this->settings[$Model->alias] = array_merge($default, $settings);
        }

        /**
         * Converte os campos definidos no setup para data formato ISO antes da validação de dados
         * @param Model $Model
         * @param array $options
         * @return boolean
         */
        public function beforeValidate(Model $Model, $options = array()) {
            if (!empty($this->settings[$Model->alias]['fields'])) {
                foreach ($this->settings[$Model->alias]['fields'] as $field) {
                    if ($Model->hasField($field) && isset($Model->data[$Model->alias][$field])) {
                        DateConverter::iso($Model->data[$Model->alias][$field]);
                    }
                }
            }
            return parent::beforeValidate($Model, $options);
        }

    }
    