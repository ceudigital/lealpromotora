<?php

    /**
     * 
     * AdminActionHelper
     *
     * @author Andre Araujo
     * 
     * @property HtmlHelper $Html
     */
    class AdminActionHelper extends AppHelper {

        /**
         * Lista de helpers
         * @var array
         */
        public $helpers = array('Html');

        /**
         * Incluir um bot�o de a��o no viewBlock 'actions'
         * @param string $label R�tulo
         * @param array|string $url URL
         * @param array $options Op��es
         * @param string $block Nome do block para acrescenter o conte�do ou false para retorn�-lo
         * @return string Se $block for diferente de vazio retorna o HTML do bot�o
         */
        public function button($label, $url, $bagde = null, $enabled = true, $options = array(), $block = 'actions') {
            $defaults = array('class' => 'btn btn-xs btn-primary');
            if (isset($options['class'])) {
                $defaults = $this->addClass($defaults, $options['class']);
            }
            if (!is_null($bagde)) {
                $defaults['escape'] = false;
                $label = sprintf('%s <span class="badge">%s</span>', $label, $bagde);
            }
            $options = array_merge($options, $defaults);
            if ($enabled) {
                $html = $this->Html->link($label, $url, $options);
            } else {
                $options = $this->addClass($options, 'disabled');
                $html = $this->Html->tag('span', $label, $options);
            }
            if (!empty($block)) {
                $this->_View->append($block, $html);
                return;
            }
            return $html;
        }

        /**
         * Bot�o para a��o index
         * @param string $block Nome do block para acrescenter o conte�do ou false para retorn�-lo
         * @return string Se $block for diferente de vazio retorna o HTML do bot�o
         */
        public function index($block = 'actions') {
            return $this->button('Listar', array('action' => 'index'), null, true, array('icon' => 'fa fa-list'), $block);
        }

        /**
         * Bot�o para a��o add
         * @param string $block Nome do block para acrescenter o conte�do ou false para retorn�-lo
         * @return string Se $block for diferente de vazio retorna o HTML do bot�o
         */
        public function add($block = 'actions') {
            return $this->button('Incluir', array('action' => 'add'), null, true, array('icon' => 'fa fa-plus-circle'), $block);
        }

        /**
         * Bot�o para edi�ao
         * @param array $id ID do item
         * @param string $block Nome do block para acrescenter o conte�do ou false para retorn�-lo
         * @return string Se $block for diferente de vazio retorna o HTML do bot�o
         */
        public function edit($id, $block = 'actions') {
            return $this->button('Editar', array('action' => 'edit'), null, true, array('icon' => 'fa fa-edit'), $block);
        }

    }
    