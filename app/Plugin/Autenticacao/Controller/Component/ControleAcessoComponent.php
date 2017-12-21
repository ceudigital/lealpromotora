<?php

    /**
     * ControleAcessoComponent
     *
     * 23/05/2011
     * $config['pagina_acesso'] pode ser um array associativo indexado
     * pelo nome do perfil do usuario
     */
    class ControleAcessoComponent extends Component {

        /**
         *
         * @var type 
         */
        public $components = array('Session', 'RequestHandler');

        /**
         *
         * @var type 
         */
        public $config = array(
            'var_usuario_login' => 'email',
            'var_usuario_senha' => 'password',
            'tabela_usuario_login' => 'email',
            'tabela_usuario_senha' => 'password',
            'var_redirecionamento_url' => 'redirect',
            'exibir_var_redirecionamento_url' => true,
            'model_usuario' => 'AutenticacaoUsuario',
            'model_grupo' => 'AutenticacaoGrupo',
            'model_permissao' => 'AutenticacaoPermissao',
            'tabela_usuario_ultimo_login' => 'ultima_visita',
            'pagina_login' => '/login',
            'pagina_logout' => '/login',
            'pagina_acesso' => null,
            'hashkey' => null,
            'auto_redirecionamento' => true,
            'algoritmo_criptografia' => 'sha1',
            'login_caracteres_permitidos' => array('@', '.', '_'),
            'prefixo_sessao' => null,
        );
        public $restricoes = array();
        public $controller = true;
        //??
        public $redirect_page;
        public $cookie = array(
            'active' => true,
            'lifetime' => '+1 day',
        );
        //verificar
        public $allowedAssocUserModels = array();
        public $allowedAssocGroupModels = array();
        public $allowedAssocPermissionModels = array();

        /**
         * @deprecated N?o utilizado, pois ? chamado ap?s o beforeFilter
         * @param mixed $controller Controller
         */
        public function initialize(Controller $controller) {
            $this->controller = $controller;
        }

        /**
         * @param Array $config Array com informações para sobreescrever a
         * configuração padrão do componente
         */
        public function config($config = array()) {
            $this->config = array_merge($this->config, $config);
            if (empty($this->config['prefixo_sessao']) || empty($this->config['hashkey'])) {
                throw new CakeException('"prefixo_sessao" e/ou "hashkey" não definidos na configuração do componente');
            }
            $this->_config_para_view();
        }

        /**
         * Incluir uma restricao
         * @param <type> $restriction
         */
        public function restringir($restriction) {
            $this->restricoes[] = $restriction;
        }

        /**
         * Efeutar login
         * @return <type>
         */
        public function login() {
            //Copia o array "data" do controller
            $params = $this->controller->request->data[$this->config['model_usuario']];
            //Apaga o campo senha do request
            unset($this->controller->request->data[$this->config['model_usuario']][$this->config['var_usuario_senha']]);
            //Dados de login/senha n?o informados -> erro
            if (($params == null) || empty($params[$this->config['var_usuario_login']]) || empty($params[$this->config['var_usuario_senha']])) {
                throw new CakeException('Usuário e/ou senha não informados.');
            }

            //Dados seguros para login
            App::uses('Sanitize', 'Utility');
            $login = Sanitize::paranoid($params[$this->config['var_usuario_login']], $this->config['login_caracteres_permitidos']);
            $passw = $params[$this->config['var_usuario_senha']];


            //Login ou senha vazio -> erro
            if (empty($login) || empty($passw)) {
                throw new CakeException('Usuário e/ou senha não informados.');
            }
            //Cifra a senha
            $passw = $this->_hash($passw);

            //Condições para busca do usuário
            $conditions[$this->config['tabela_usuario_login']] = $login;
            $conditions[$this->config['tabela_usuario_senha']] = $passw;
            $recursive = 2;

            //Busca o usuario
            $UserModel = $this->_instanciar_model();

            $row = $UserModel->find('first', compact('conditions', 'recursive'));

            if (!empty($row)) {
                if ($row[$this->config['model_usuario']]['ativo']) {
                    //Grava em sess?o
                    $this->_salvar_sessao($row);
                    //Atualiza ultima visita
                    $this->_atualizar_ultimo_login($UserModel, $row);
                    //Redireciona para pagina inicial
                    if ($this->config['auto_redirecionamento'] == true) {
                        if (!empty($row[$this->config['model_grupo']]['redirecionar'])) {
                            $this->redirecionar($row[$this->config['model_grupo']]['redirecionar'], false);
                        } elseif (is_string($this->config['pagina_acesso'])) {
                            $this->redirecionar($this->config['pagina_acesso'], false);
                        } elseif (is_array($this->config['pagina_acesso'])) {
                            $this->redirecionar($this->config['pagina_acesso'][$row[$this->config['model_usuario']]['perfil']], false);
                        } else {
                            throw new CakeException('Não é possível fazer login pois não há página para redirecionamento definida para o usuário.');
                        }
                    }
                } else {
                    throw new CakeException('Este usuário encontra-se inativo.');
                }
            } else {
                throw new CakeException('Usuário e/ou senha incorretos.');
            }
        }

        /**
         * Encerrar a sess?o do usu?rio e redirecionar para a p?gina de login
         */
        public function logout() {
            $session_key = $this->getSessionKey();
            if ($this->Session->valid() && $this->Session->check($session_key)) {
                $ses = $this->Session->read($session_key);
                if (!empty($ses) && is_array($ses)) {
                    $this->Session->delete($session_key);
                    $this->Session->delete($this->config['prefixo_sessao'] . '.frompage');
                }
            }
            if ($this->config['auto_redirecionamento'] && !empty($this->config['pagina_logout'])) {
                $this->redirecionar($this->config['pagina_logout']);
            }
        }

        /**
         * Verifica se um login ainda é válido e checa permissão é página atual
         */
        public function verificar() {
            //Se a pagina atual e restrita         
            if ($this->_restricoes_validas()) {
                $session_key = $this->getSessionKey();
                // se a sessão existe
                if ($this->Session->valid() && $this->Session->check($session_key)) {
                    //busca dados da sessão
                    $session = $this->Session->read($session_key);
                    if (!isset($session["{$this->config['model_usuario']}"][$this->config['tabela_usuario_login']])) {
                        $this->logout();
                        return false;
                    }
                    $login = $session["{$this->config['model_usuario']}"][$this->config['tabela_usuario_login']];
                    $login_hash = $session["{$this->config['model_usuario']}"]['login_hash'];
                    // testa se o hash na sessão é válido
                    if ($this->_hash($this->config['hashkey'] . $login) != $login_hash) {
                        $this->logout();
                        return false;
                    }
                    // verifica se usuário tem permissao no para controller/action/p/a/r/a/m/s
                    $hasPermission = $this->_verificar_permissao($session, true);
                    if (!$hasPermission) {
                        if ($this->config['auto_redirecionamento'] == true) {
                            throw new ForbiddenException('Você não tem permissão para acessar esta página.');
                        } else {
                            return false;
                        }
                    }
                    return true;
                } else {
                    //sessão invalida - redireciona para login/retorna falso					
                    if ($this->config['auto_redirecionamento'] == true) {
                        throw new ForbiddenException('Sessão inválida, por favor faça login.');
                    } else {
                        return false;
                    }
                }
            }
            //ok, nao e uma pagina restrita
            return true;
        }

        /**
         * 		verifica se usuário tem permissao no para controller/action/p/a/r/a/m/s
         */
        public function _verificar_permissao($session) {
            App::import('Core', 'Inflector');
            $controller = strtolower(Inflector::underscore($this->controller->name));
            $action = strtolower($this->controller->request->params['action']);
            $here = strtolower($this->controller->request->here);
            $controller_action = $this->_tratar_rotas_prefixadas($controller, $action);
            $params = isset($this->controller->request->params['pass']) ? implode('/', $this->controller->request->params['pass']) : '';
            $controller_action_params = $controller_action . '/' . $params;
            $return = false;
            $session_permissions = Set::extract(sprintf('/%s/%s/descricao', $this->config['model_grupo'], $this->config['model_permissao']), $session);
            $a_p_in_array = in_array($action . '/' . $params, $this->restricoes);
            // if current url is restricted, do a strict compare
            // ex if current url action/p and current/p is in the list
            // then the user need to have it in perms
            // current/p/s current/p
            //CakeLog::write('controle_acesso',	$controller_action_params);
            if ($a_p_in_array) {
                foreach ($session_permissions as $p) {
                    if ($controller_action_params == strtolower($p)) {
                        $return = true;
                        break;
                    }
                }
            } else {
                // allow a user with permssion on the current action to access deeper levels
                // ex: user access = 'action', allow 'action/p'
                foreach ($session_permissions as $p) {
                    //$this->log(sprintf("%s\t\t%s", $controller_action_params, $p), 'cac');
                    if (strpos($controller_action_params, strtolower($p)) === 0) {
                        $return = true;
                        break;
                    }
                }
            }
            //$this->log(sprintf('return %d', $return), 'cac');
            return $return;
        }

        public function _restricoes_validas() {
            if (isset($this->restricoes)) {
                $restricoes = $this->restricoes;
                if (is_array($restricoes)) {
                    if (count(Configure::read('Routing.prefixes'))) {
                        if ($this->restricoes_possuem_rotas_prefixadas()) {
                            if ($this->eh_rota_prefixada()) {
                                if ($this->_nao_eh_pagina_atual($this->config['pagina_login']) &&
                                        $this->_nao_eh_pagina_atual($this->config['pagina_logout'])) {
                                    return true;
                                }
                            }
                        }
                    }
                    foreach ($restricoes as $restricao) {
                        $pos = strpos($restricao . "/", $this->controller->action . "/");
                        if ($pos === 0) {
                            return true;
                        }
                    }
                }
            }
            return false;
        }

        /**
         * Informa se $page é a página atual
         * @param <type> $page
         * @return <type>
         */
        public function _nao_eh_pagina_atual($page) {
            if ($page == '') {
                return false;
            }
            App::import('Core', 'Inflector');
            $controller = strtolower(Inflector::underscore($this->controller->name));
            $action = strtolower($this->controller->request->params['action']);
            $page = strtolower($page . '/');
            $controller_action = $this->_tratar_rotas_prefixadas($controller, $action);
            if ($page[0] == '/') {
                $controller_action = '/' . $controller_action;
            }
            //die($controller_action.' '.$page);
            $not_current = strpos($page, $controller_action);
            // !== is required, $not_current might be boolean(false)
            return ((!is_int($not_current)) || ($not_current !== 0));
        }

        /**
         * Redirecionar para uma página
         */
        public function redirecionar($page = '', $back = false) {
            if ($page == '') {
                $page = $this->config['pagina_logout'];
            }
            if (!empty($this->config['var_redirecionamento_url'])) {
                if ($back == true) {
                    $frompage = '/';
                    if (!empty($this->controller->request->url)) {
                        $frompage .= $this->controller->request->url;  //if url is set then set frompage to url
                        $parameters = $this->controller->request->query; // get url array
                        unset($parameters['url']);
                        $para = array();
                        foreach ($parameters as $key => $value) { //for each parameter of the url create key=value string
                            $para[] = $key . '=' . $value;
                        }
                        if (count($para) > 0) {
                            $frompage .= '?' . implode('&amp;', $para); //attach parameters to the frompage
                        }
                    }
                    $this->Session->write($this->config['prefixo_sessao'] . '.frompage', $frompage);
                    if ($this->config['exibir_var_redirecionamento_url']) {
                        $page .= "?" . $this->config['var_redirecionamento_url'] . "=" . $frompage;
                    }
                } else {
                    if ($this->Session->check($this->config['prefixo_sessao'] . '.frompage')) {
                        $page = $this->Session->read($this->config['prefixo_sessao'] . '.frompage');
                        $this->Session->delete($this->config['prefixo_sessao'] . '.frompage');
                    }
                }
            }
            if (!$this->_eh_pagina_atual($page)) {
                if ($this->controller->request->is('ajax')) {
                    $this->controller->layout = $this->RequestHandler->ajaxLayout;
                    $this->RequestHandler->respondAs('html', array('charset' => 'UTF-8'));
                    echo sprintf('<script type="text/javascript">window.location = \'%s\'</script>', $this->url($page));
                    exit;
                } else {
                    $this->controller->redirect($page);
                    exit;
                }
            }
        }

        public function url($page) {
            return $page;
        }

        /**
         * Efetua a instancia??o da classe Model
         */
        public function _instanciar_model() {
            $Model = ClassRegistry::init('Autenticacao.' . $this->config['model_usuario']);
            return $Model;
        }

        /**
         * Atualiza a data de último login
         */
        public function _atualizar_ultimo_login($UserModel, $row) {
            if (!empty($this->config['tabela_usuario_ultimo_login'])) {
                $UserModel->create($row);
                $UserModel->saveField($this->config['tabela_usuario_ultimo_login'], date('Y-m-d H:i:s'));
            }
        }

        /**
         * Salva os dados do usuário atual em sessão
         * @param mixed $row Dados do usuário atual
         */
        public function _salvar_sessao($row) {
            $login = $row[$this->config['model_usuario']][$this->config['tabela_usuario_login']];
            $hk = $this->_hash($this->config['hashkey'] . $login);
            $row["{$this->config['model_usuario']}"]['login_hash'] = $hk;
            $row["{$this->config['model_usuario']}"]['hashkey'] = $this->config['hashkey'];
            $this->Session->write($this->config['prefixo_sessao'] . '.' . $this->config['hashkey'], $row);
        }

        /**
         * Atualiza os dados de sess?o do usu?rio logado
         * @param array $row Dados no do usu?rio $row[$this->config['model_usuario']]
         */
        public function _atualiza_usuario_sessao($row) {
            $session_key = $this->config['prefixo_sessao'] . '.' . $this->config['hashkey'] . '.' . $this->config['model_usuario'];
            $ses = $this->Session->read($session_key);
            $row = $row["{$this->config['model_usuario']}"];
            $ses = array_merge($ses, $row);
            $this->Session->write($this->config['prefixo_sessao'] . '.' . $this->config['hashkey'] . '.' . $this->config['model_usuario'], $ses);
        }

        /**
         * Retorna o hash de $str de acordo com o algortimo definido na
         * configura??o
         * @param String $str String
         * @return String Hash de $str
         */
        public function _hash($str) {
            switch ($this->config['algoritmo_criptografia']) {
                case 'sha1':
                    return ($str == '') ? '' : sha1($str);
                    break;
                case 'crypt':
                    return crypt($str);
                    break;
                case 'base64':
                    return base64_encode($str);
                    break;
                case 'plain':
                    return $str;
                    break;
                case 'md5':
                default:
                    return md5($str);
                    break;
            }
        }

        /**
         * Passa dos dados do componente para a view para ser usada pelo
         * helper
         * @deprecated
         */
        public function _dados_para_view() {
            $data = get_object_vars($this);
            unset($data['controller']);
            unset($data['components']);
            unset($data['Session']);
            unset($data['RequestHandler']);
            $this->controller->set('seguranca_data', $data);
        }

        /**
         * Passa as configura??es do componente para a view para ser usada pelo
         * helper
         */
        public function _config_para_view() {
            $this->controller->set('ControleAcessoConfig', $this->config);
        }

        /**
         * Trata as rotas prefixadas do cake
         */
        public function _tratar_rotas_prefixadas($controller, $action) {
            $routing_prefixes = Configure::read('Routing.prefixes');
            //Existe prefixos
            if (!empty($routing_prefixes)) {
                //Verifica para cada prefixo se a action come?a por ele
                foreach ($routing_prefixes as $prefix) {
                    $strpos = strpos($action, $prefix . '_');
                    if ($strpos === 0) {
                        $function = substr($action, strlen($prefix . '_'));
                        if ($controller == null) {
                            return $function . '/';
                        }
                        if (empty($this->controller->request->params['plugin']) || $controller == $this->controller->request->params['plugin']) {
                            //Se o plugin for vazio ou for igual ao controlador retorna /prefix/controller/action
                            $controller_action = sprintf('%s/%s/%s', $prefix, $controller, $function);
                        } else {
                            //Caso contr?rio, retorna /prefix/plugin/controller/action
                            $plugin = $this->controller->request->params['plugin'];
                            $controller_action = sprintf('%s/%s/%s/%s', $prefix, $plugin, $controller, $function);
                        }
                        return $controller_action;
                    }
                }
            }
            //Se n?o encontrar nenhum prefixo na a??o atual retorna por aqui
            if ($controller == null) {
                return $action . '/';
            } else {
                return $controller . '/' . $action . '/';
            }
        }

        /**
         * Informa se $page ? a p?gina atual
         */
        public function _eh_pagina_atual($page) {
            if ($page == "") {
                return false;
            }
            App::import('Core', 'Inflector');
            $controller = strtolower(Inflector::underscore($this->controller->name));
            $action = strtolower($this->controller->action);
            $page = strtolower($page . '/');
            $controller_action = $this->_tratar_rotas_prefixadas($controller, $action);
            if ($page[0] == '/') {
                $controller_action = '/' . $controller_action;
            }
            //die($controller_action	.	' '	.	$page);
            return strpos($page, $controller_action) === 0;
        }

        /**
         * Informa se as restri??es definidas possuem alguma
         * dos prefixos
         * @return <type>
         */
        public function restricoes_possuem_rotas_prefixadas() {
            $routes = Configure::read('Routing.prefixes');
            foreach ($this->restricoes as $restriction) {
                if (in_array($restriction, $routes)) {
                    return true;
                }
            }
            return false;
        }

        /**
         * Verifica se a a??o atual possui alguns dos prefixos
         * configurados
         * @return boolean True se a a??o possui um prefixo
         */
        public function eh_rota_prefixada() {
            $routes = Configure::read('Routing.prefixes');
            if (count($routes)) {
                $a = $this->controller->action;
                foreach ($routes as $route) {
                    $strpos = strpos($a, $route . '_');
                    if ($strpos === 0) {
                        return true;
                    }
                }
            }
            return false;
        }

        // helper methods
        public function usuario($arg) {
            $session_key = $this->getSessionKey();
            // does session exists
            if ($this->Session->valid() && $this->Session->check($session_key)) {
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
            // does session exists
            if ($this->Session->valid() && $this->Session->check($session_key)) {
                $ses = $this->Session->read($session_key);
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
            if ($this->Session->valid() && $this->Session->check($session_key)) {
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

        public function getSessionKey() {
            return sprintf('%s.%s', $this->config['prefixo_sessao'], $this->config['hashkey']);
        }

    }
    