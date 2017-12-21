<?php

    /**
     * Description of AdminWidgetHelper
     *
     * @author Andre Araujo
     * 
     * @property HtmlHelper $Html
     */
    class AdminWidgetHelper extends AppHelper {

        /**
         * Lista de helpers utilizados por este helper
         * @var array
         */
        public $helpers = array('Html');

        /**
         * Progress bar
         * @param int $value Valor
         * @param int $max Valor máximo
         * @param false|string $label False para não exibir ou string para ser usado em sprintf prevendo local para o percentual
         * @param string $size Null (default) para tamanho padrão. Outras opções são progress-small progress-mini
         * @return string HTML
         */
        public function progressBar($value, $max, $label = 'Progresso %d%%', $size = null) {
            $percent = round($value / $max * 100);
            $html = array();
            //Rótulo
            if (is_string($label)) {
                $html[] = $this->Html->tag('small', sprintf($label, $percent));
            }
            //Barra de progresso
            $progress_bar = $this->Html->tag('div', '', array(
                'style' => sprintf('width:%d%%', $percent),
                'class' => 'progress-bar animated slideInLeft',
            ));
            $options = array('class' => 'progress');
            $options = $size ? $this->addClass($options, $size) : $options;
            $html[] = $this->Html->tag('div', $progress_bar, $options);
            return implode('', $html);
        }

    }
    