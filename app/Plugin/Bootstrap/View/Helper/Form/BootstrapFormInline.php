<?php

    App::uses('IBootstrapForm', 'Bootstrap.View/Helper/Form');

    class BootstrapFormInline implements IBootstrapForm {

        /**
         * @return array Array com as op��es para inicializa��o do form
         */
        public function getFormOptions() {
            return array(
                'role' => 'form',
                'class' => 'form-inline',
                'inputDefaults' => array(
                    'div' => array(
                        'class' => 'form-group'
                    ),
                    'label' => array(
                        'class' => 'control-label'
                    ),
                    'class' => 'form-control',
                    'between' => '&nbsp;',
                    'after' => '&nbsp;',
                    'error' => array(
                        'attributes' => array(
                            'wrap' => 'span',
                            'class' => 'text-danger small'
                        )
                    ),
                ),
            );
        }

        /**
         * Aplica as  altera��es necess�rias para formata��o de campos tipo checkbox
         * @param string $fieldName Nome do campo
         * @param array $options Array de op��es do campo
         */
        public function formatCheckbox($fieldName, $options) {
            return $options;
        }

        /**
         * Aplica as  altera��es necess�rias para formata��o de elementos button
         * @param string $html
         */
        public function formatButton($html) {
            return $html;
        }

        /**
         * Aplica as  altera��es necess�rias para formata��o de elementos submit
         * @param string $html
         */
        public function formatSubmit($caption, $options) {
            $options['div'] = false;
            return $options;
        }

        public function formatRadio($fieldName, $options) {
            return $options;
        }

    }
    