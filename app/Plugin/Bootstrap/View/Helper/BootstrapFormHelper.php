<?php

    App::uses('FormHelper', 'View/Helper');
    App::uses('BootstrapFormBasic', 'Bootstrap.View/Helper/Form');
    App::uses('BootstrapFormInline', 'Bootstrap.View/Helper/Form');
    App::uses('BootstrapFormHorizontal', 'Bootstrap.View/Helper/Form');
    App::uses('BootstrapFormNotFoundException', 'Bootstrap.Lib/Exception');

    class BootstrapFormHelper extends FormHelper {

        /**
         * @var BootstrapForm
         */
        private $BootstrapForm = null;

        /**
         * Cria��o de formul�rio
         * @param Model $model
         * @param array $options Inclui a op��o 'type'
         * - vazio ou "basic": define padr�es para formul�rio b�sico do bootstrap
         * @return string
         */
        public function create($model = null, $options = array()) {
            $this->initBootstrapForm($options);
            $options = array_merge($options, $this->BootstrapForm->getFormOptions());
            $options['novalidate'] = 'novalidate';
            return parent::create($model, $options);
        }

        /**
         * Instancia a classe respons�vel por realizar os tratamentos necess�rios
         * para gera��o do c�digo HTML de acordo com o esperado pelo Bootstrap e 
         * com o tipo de formul�rio especificado		  * 
         * @param array $options 
         */
        private function initBootstrapForm(&$options) {
            $options['type'] = isset($options['type']) ? $options['type'] : 'basic';
            $classname = sprintf('BootstrapForm%s', ucfirst($options['type']));
            if (!class_exists($classname)) {
                throw new BootstrapFormNotFoundException($classname);
            }
            $this->BootstrapForm = new $classname();
            unset($options['type']);
        }

        /**
         * 
         * @param type $fieldName
         * @param type $options
         * @return type
         */
        public function input($fieldName, $options = array()) {
            //Label
            if (isset($options['label']) && is_string($options['label'])) {
                $formOptions = $this->BootstrapForm->getFormOptions();
                $options['label'] = array('text' => $options['label']);
                $options['label'] = array_merge_recursive($formOptions['inputDefaults']['label'], $options['label']);
            }
            $options = $this->BootstrapForm->formatCheckbox($fieldName, $options);
            $options = $this->BootstrapForm->formatRadio($fieldName, $options);
            $this->setEntity($fieldName);
            if ($this->tagIsInvalid()) {
                $options['div'] = 'form-group has-error';
            }
            return parent::input($fieldName, $options);
        }

        public function select($fieldName, $options = array(), $attributes = array()) {
            if (isset($attributes['multiple']) && $attributes['multiple'] == 'checkbox') {
                $attributes = $this->addClass($attributes, 'checkbox');
            }
            return parent::select($fieldName, $options, $attributes);
        }

        /**
         * Button
         * @param type $title
         * @param array $options
         * @return type
         */
        public function button($title, $options = array()) {
            $options = $this->addClass($options, 'btn');
            $html = parent::button($title, $options);
            $wrap = isset($options['wrap']) && $options['wrap'] ? true : false;
            return $this->BootstrapForm->formatButton($html, $wrap);
        }

        /**
         * Submit
         * @param type $caption
         * @param type $options
         * @return type
         */
        public function submit($caption = null, $options = array()) {
            $options = $this->addClass($options, 'btn');
            $options = $this->BootstrapForm->formatSubmit($caption, $options);
            return parent::submit($caption, $options);
        }

    }
    