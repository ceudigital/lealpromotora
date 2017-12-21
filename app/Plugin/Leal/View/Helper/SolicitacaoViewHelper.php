<?php

    App::uses('CakeNumber', 'Utility');

    /**
     * Description of SolicitacaoViewHelper
     *
     * @author Andre Araujo
     *
     * @property FormHelper $Form
     * @property HtmlHelper $Html
     *
     */
    class SolicitacaoViewHelper extends AppHelper {

        /**
         * Lista de helpers utilizados neste helper
         * @var array
         */
        public $helpers = array(
            'Form',
            'Html',
        );

        public function beforeRender($viewFile) {
            parent::beforeRender($viewFile);
            $js = <<<JS
    $(function(){
        var clipboard = new Clipboard('button[data-clipboard-target]');
    });       
JS;
            $this->Html->script('clipboard.min', array('inline' => false));
            $this->_View->append('script', $this->Html->scriptBlock($js));
        }

        public function input($fieldName, $options = array()) {
            $options['readonly'] = 'readonly';
            $options['between'] = '<div class="col-sm-9 input-group">';
            $options['after'] = '<span class="input-group-btn">' . $this->clipboard($fieldName) . '</span></div>';
            return $this->Form->input($fieldName, $options);
        }

        private function clipboard($fieldName) {
            $this->Form->setEntity($fieldName);
            $id = $this->Form->domId();
            $options = array(
                'title' => 'Copiar',
                'type' => 'button',
                'class' => 'btn btn-white',
                'data-toggle' => 'tooltip',
                'data-placement' => 'right',
                'data-clipboard-target' => sprintf('#%s', $id),
            );
            return $this->Html->tag('button', '<i class="fa fa-copy"></i>', $options);
        }

    }
    