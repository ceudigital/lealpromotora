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
         * Incluir um botão de ação no viewBlock 'actions'
         * @param string $label Rótulo
         * @param array|string $url URL
         * @param array $options Opções
         * @param string $block Nome do block para acrescenter o conteúdo ou false para retorná-lo
         * @return string Se $block for diferente de vazio retorna o HTML do botão
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
         * Botão para ação index
         * @param string $block Nome do block para acrescenter o conteúdo ou false para retorná-lo
         * @return string Se $block for diferente de vazio retorna o HTML do botão
         */
        public function index($block = 'actions') {
            return $this->button('Listar', array('action' => 'index'), null, true, array('icon' => 'fa fa-list'), $block);
        }

        /**
         * Botão para ação add
         * @param string $block Nome do block para acrescenter o conteúdo ou false para retorná-lo
         * @return string Se $block for diferente de vazio retorna o HTML do botão
         */
        public function add($block = 'actions') {
            return $this->button('Incluir', array('action' => 'add'), null, true, array('icon' => 'fa fa-plus-circle'), $block);
        }

        /**
         * Botão para ediçao
         * @param array $id ID do item
         * @param string $block Nome do block para acrescenter o conteúdo ou false para retorná-lo
         * @return string Se $block for diferente de vazio retorna o HTML do botão
         */
        public function edit($id, $block = 'actions') {
            return $this->button('Editar', array('action' => 'edit'), null, true, array('icon' => 'fa fa-edit'), $block);
        }

    }
    