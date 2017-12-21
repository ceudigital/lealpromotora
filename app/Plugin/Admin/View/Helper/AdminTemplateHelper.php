<?php

    Configure::load('sistema');

    /**
     * AdminTemplateHelper
     * 
     * @author Andre Araujo
     * 
     * @property HtmlHelper $Html
     * @property ControleAcessoHelper $ControleAcesso
     */
    class AdminTemplateHelper extends AppHelper {

        /**
         * Lista de helpers
         * @var array
         */
        public $helpers = array('AutenticacaoCentral.ControleAcesso');

        public function pageHeading($title) {
            return $this->_View->element('Admin.admin/page_heading', compact('title'));
        }

        /**
         * @return string Html
         */
        public function topNavigation() {
            $icon = Configure::read('Sistema.icone');
            $title = Configure::read('Sistema.titulo');
            return $this->_View->element('Admin.admin/top_navigation', compact('icon', 'title'));
        }

        /**
         * @return string Html
         */
        public function sideMenu() {
            $menu = Configure::read('Sistema.menu');
            $usuario = 'Augusto';
            return $this->_View->element('Admin.admin/side_menu', compact('usuario', 'menu'));
        }

        /**
         * @param string $sistema
         * @param string $icone
         * @param string $versao
         * @param string $data
         * @return string Html
         */
        public function footer() {
            $sistema = Configure::read('Sistema.titulo');
            $icone = Configure::read('Sistema.icone');
            $versao = Configure::read('Sistema.versao');
            $data = Configure::read('Sistema.data');
            return $this->_View->element('Admin.admin/footer', compact('sistema', 'icone', 'versao', 'data'));
        }

    }
    