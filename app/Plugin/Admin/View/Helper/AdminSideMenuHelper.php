<?php

    /**
     * 
     * AdminSideMenuHelper
     *
     * @author Andre Araujo
     * 
     * @property ControleAcessoHelper $ControleAcesso
     */
    class AdminSideMenuHelper extends AppHelper {

        /**
         * Exibi??o do menu lateral
         * @param array $menu Dados menu
         * @return string HTML
         */
        public function display($menu) {
            $html = array();
            foreach ($menu as $label => $params) {
                switch (true) {
                    case array_key_exists('url', $params):
                        $current = $this->isCurrent($params['url']);
                        $html[] = $this->_View->element('Admin.admin/side_menu_item', compact('label', 'params', 'current'));
                        break;
                    case array_key_exists('links', $params):
                        $current = $this->hasCurrentItem($params['links']);
                        $html[] = $this->_View->element('Admin.admin/side_sub_menu', compact('label', 'params', 'current'));
                        break;
                }
            }
            return implode('', $html);
        }

        /**
         * Informa se o menu possui itens para exibiçaõ (que o usuário atual tenha permissão de acesso)
         * @param array $links Lista de links do menu
         * @return boolean
         */
        private function hasMenuitem($links) {
            $hasMenuitem = false;
            foreach ($links as $url) {
                if (true) {
                    $hasMenuitem = true;
                    break;
                }
            }
            return $hasMenuitem;
        }

        /**
         * Informa se uma URL é a atual
         * @param array $url Lista de links do menu
         * @return boolean
         */
        public function isCurrent(array $url) {
            return strpos(Router::url(), Router::url($url)) === 0;
        }

        /**
         * Informa se o menu está ativo (possui link atual)
         * @param array $links Lista de links do menu
         * @return boolean
         */
        public function hasCurrentItem(array $links) {
            $hasCurrent = false;
            foreach ($links as $label => $url) {
                if ($this->isCurrent($url)) {
                    $hasCurrent = true;
                    break;
                }
            }
            return $hasCurrent;
        }

    }
    