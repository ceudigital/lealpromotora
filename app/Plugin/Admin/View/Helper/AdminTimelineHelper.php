<?php

    /**
     * 
     * Céu Digital - http://www.ceudigital.com.br
     * Limites?!
     * 
     * AdminTimeLineHelper
     *
     * @author Andre Araujo
     */
    class AdminTimelineHelper extends AppHelper {

        /**
         * Lista de itens
         * @var array
         */
        private $timeline_itens = array();

        /**
         * Gera HTML para exibição de timeline com os itens atuais
         * @return string HTML
         */
        public function timeline() {
            $itens = implode(' ', $this->timeline_itens);
            return $this->_View->element('Admin.timeline/timeline', compact('itens'));
        }

        /**
         * Incluir um item na timeline
         * @param string $text
         * @param string $class
         * @param string $icon
         * @param string $date
         */
        public function addItem($text, $class, $icon, $date) {
            $this->timeline_itens[] = $this->_View->element('Admin.timeline/timeline_item', compact('text', 'class', 'icon', 'date'));
        }

        /**
         * Limpar os itens atuais
         */
        public function reset() {
            $this->timeline_itens = array();
        }

    }
    