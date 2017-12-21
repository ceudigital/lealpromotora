<?php

    App::uses('IBootstrapForm', 'Bootstrap.View/Helper/Form');

    class BootstrapFormHorizontal implements IBootstrapForm {

        /**
         * @return array Array com as opções para inicialização do form
         */
        public function getFormOptions() {
            return array(
                'role' => 'form',
                'class' => 'form-horizontal',
                'inputDefaults' => array(
                    'div' => array(
                        'class' => 'form-group'
                    ),
                    'class' => 'form-control',
                    'between' => '<div class="col-sm-9">',
                    'after' => '</div>',
                    'label' => array(
                        'class' => 'col-sm-3 control-label'
                    ),
                    'error' => array(
                        'div' => 'has-error',
                        'attributes' => array(
                            'wrap' => 'span',
                            'class' => 'col-sm-offset-3 col-sm-9 text-danger small'
                        )
                    ),
                ),
            );
        }

        /**
         * Aplica as  alterações necessárias para formatação de campos tipo checkbox
         * @param string $fieldName Nome do campo
         * @param array $options Array de opções do campo
         * 
         * <div class="form-group">
          <div class="col-lg-offset-2 col-lg-10">
          <div class="i-checks">
          </div>
          </div>
         */
        public function formatCheckbox($fieldName, $options) {
            if (isset($options['type']) && $options['type'] == 'checkbox') {
                $label = isset($options['label']['text']) ? $options['label']['text'] : Inflector::humanize($fieldName);
                $options['div'] = 'form-group';
                $options['class'] = null;
                $options['label'] = false;
                $options['before'] = '<div class="col-sm-offset-3 col-sm-9"><label>';
                $options['between'] = null;
                $options['after'] = sprintf(' %s </label></div>', $label);
                $options['format'] = array('before', 'label', 'between', 'input', 'after', 'error');
            }
            return $options;
        }

        /**
         * Aplica as  alterações necessárias para formatação de campos tipo checkbox
         * @param string $fieldName Nome do campo
         * @param array $options Array de opções do campo
         */
        public function formatRadio($fieldName, $options) {
            if (isset($options['type']) && $options['type'] == 'radio') {
                $options['div'] = 'radio';
                $options['separator'] = '<br style="line-height:150%" />';
                $options['legend'] = false;
                $options['before'] = '<div class="col-sm-9">';
                if (isset($options['label'])) {
                    $options['before'] = sprintf('<label class="%s">%s</label>%s', $options['label']['class'], $options['label']['text'], $options['before']);
                    $options['label'] = false;
                }
                $options['between'] = null;
                $options['after'] = '</div>';
            }
            return $options;
        }

        /**
         * Aplica as  alterações necessárias para formatação de elementos button
         * @param string $html
         */
        public function formatButton($html, $wrap = true) {
            return $wrap ? sprintf('<div class="form-group"><div class="col-sm-offset-3 col-sm-9">%s</div></div>', $html) : $html;
        }

        /**
         * Aplica as  alterações necessárias para formatação de elementos submit
         * @param string $html
         */
        public function formatSubmit($caption, $options) {
            $options['div'] = 'form-group';
            $options['before'] = '<div class="col-sm-offset-3 col-sm-9">';
            $options['after'] = '</div>';
            return $options;
        }

    }
    