<?php

   class ControleAcessoHelper extends AppHelper {

      /**
       * Helpers
       * @var array
       */
      public $helpers = array(
         'Session'
      );

      /**
       * Configura??es do Helper. As informa??es s?o carregadas na chamada do
       * m?todo init() buscando na view as informa??es que foram setadas pelo
       * ControleAcessoComponent.
       * @var array
       */
      public $config = array();

      /**
       * Faz a chamada ao construto da classe pai e chama a rotina de inicializa??o
       * do helper
       * @param View $View
       * @param type $settings 
       */
      public function __construct(View $View, $settings = array()) {
         parent::__construct($View, $settings);
         $this->init();
      }

      /**
       * Inicializa o helper
       * - Busca na view as configura??es setadas pelo ControleAcessoComponent 
       */
      private function init() {
         if (isset($this->_View->viewVars['ControleAcessoConfig'])) {
            $this->config = $this->_View->viewVars['ControleAcessoConfig'];
         }
      }

      /**
       * Informa se a sess?o do usu?rio ? valida
       * @return boolean 
       */
      private function isSessionValid() {
         if (isset($this->config['prefixo_sessao']) && isset($this->config['hashkey'])) {
            return ($this->Session->check($this->config['prefixo_sessao'] . '.' . $this->config['hashkey']));
         } else {
            return false;
         }
      }

      /**
       * Pega a sess?o do usu?rio
       * @return array
       */
      private function getSession() {
         return $this->Session->read($this->getSessionKey());
      }

      public function getSessionKey() {
         return sprintf('%s.%s', $this->config['prefixo_sessao'], $this->config['hashkey']);
      }

      // helper methods
      public function usuario($arg) {
         $session_key = $this->getSessionKey();
         if ($this->Session->check($session_key)) {
            $ses = $this->Session->read($session_key);
            if (isset($ses["{$this->config['model_usuario']}"][$arg])) {
               return $ses["{$this->config['model_usuario']}"][$arg];
            } else {
               return false;
            }
         }
         return false;
      }

      // helper methods
      public function grupo($arg) {
         $session_key = $this->getSessionKey();
         if ($this->Session->check($session_key)) {
            $ses = $this->getSession();
            if (isset($ses["{$this->config['model_grupo']}"][$arg])) {
               return $ses["{$this->config['model_grupo']}"][$arg];
            } else {
               return false;
            }
         }
         return false;
      }

      // helper methods
      public function permissao($arg) {
         $session_key = $this->getSessionKey();
         // does session exists
         if ($this->Session->check($session_key)) {
            $ses = $this->Session->read($session_key);
            if (isset($ses[$this->config['model_grupo']][$this->config['model_permissao']])) {
               $ret = array();
               if (is_array($ses[$this->config['model_grupo']][$this->config['model_permissao']])) {
                  for ($i = 0; $i < count($ses[$this->config['model_grupo']][$this->config['model_permissao']]); $i++) {
                     $ret[] = $ses[$this->config['model_grupo']][$this->config['model_permissao']][$i][$arg];
                  }
               }
               return $ret;
            } else {
               return false;
            }
         }
         return false;
      }

      /**
       * Retorna as permiss?es do usu?rio atual
       * @return type 
       */
      public function permissoes() {
         return Set::extract(sprintf('/%s/descricao', $this->config['model_permissao']), $this->grupo());
      }

      /**
       * Informa se o usu?rio atual possui permiss?o para acessar um recurso
       * identificado pela $url
       * @param array $url URL do recurso no formato cake
       * @return boolean 
       */
      public function possuiPermissao($url) {
         if (!is_array($url)) {
            return false;
         }
         $parsedUrl = $this->_parseUrl($url);
         $return = false;
         $permissoes = $this->permissoes();
         if (in_array($parsedUrl, $permissoes)) {
            $return = true;
         } else {
            foreach ($permissoes as $p) {
               if (strpos($parsedUrl, strtolower($p)) === 0) {
                  $return = true;
                  break;
               }
            }
         }
         return $return;
      }

      /**
       * Trata as rotas prefixadas do cake
       */
      private function _parseUrl($url) {
         $routing_prefixes = Configure::read('Routing.prefixes');
//Existe prefixos
         if (!empty($routing_prefixes)) {
            //Verifica para cada prefixo se a action comeca por ele
            foreach ($routing_prefixes as $prefix) {
               if (isset($url['plugin']) || !empty($this->params['plugin'])) {
                  if ($url['controller'] == null) {
                     return $url['controller'] = $this->params['controller'];
                  }
                  if (empty($url['plugin']) || $url['controller'] == $url['plugin']) {
                     //Se o plugin for vazio ou for igual ao controlador retorna /prefix/controller/action
                     $controller_action = sprintf('%s/%s/%s', $prefix, $url['controller'], $url['action']);
                  } else {
                     //Caso contrario, retorna /prefix/plugin/controller/action
                     $plugin = isset($url['plugin']) ? $url['plugin'] : $this->params['plugin'];
                     $controller_action = sprintf('%s/%s/%s/%s', $prefix, $plugin, $url['controller'], $url['action']);
                  }
                  return $controller_action;
               }
            }
         }
//Se n?o encontrar nenhum prefixo na a??o atual retorna por aqui
         if ($url['controller'] == null) {
            return $this->params['controller'] . '/' . $url['action'] . '/';
         } else {
            return $url['controller'] . '/' . $url['action'] . '/';
         }
      }

   }

?>