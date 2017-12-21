<?php

    /**
     * Application level Controller
     *
     * This file is application-wide controller file. You can put all
     * application-wide controller-related methods here.
     *
     * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
     * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
     *
     * Licensed under The MIT License
     * For full copyright and license information, please see the LICENSE.txt
     * Redistributions of files must retain the above copyright notice.
     *
     * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
     * @link          http://cakephp.org CakePHP(tm) Project
     * @package       app.Controller
     * @since         CakePHP(tm) v 0.2.9
     * @license       http://www.opensource.org/licenses/mit-license.php MIT License
     */
    App::uses('Controller', 'Controller');

    /**
     * Application Controller
     *
     * Add your application-wide methods in the class below, your controllers
     * will inherit them.
     *
     * @package		app.Controller
     * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
     * 
     * @property PageTitleComponent $PageTitle
     * @property PNotifyFlashComponent $Flash
     * @property SessionComponent $Session
     * @property ControleAcessoComponent $ControleAcesso
     */
    class AppController extends Controller {

        /**
         * Lista de nomes de components utilizados por este controller
         * @var array
         */
        public $components = array(
            'Autenticacao.ControleAcesso',
            'Flash' => array('className' => 'Jquery.PNotifyFlash'),
            'PageTitle.PageTitle' => array(
                'default' => 'Leal Promotora de Crédito',
                'separator' => ' / ',
            ),
            'Session',
        );

        /**
         * Lista de nomes de helpers utilizados por este controller
         * @var array
         */
        public $helpers = array(
            'BlueimpGallery.BlueimpGallery',
            'Admin.AdminTemplate',
            'Admin.AdminSideMenu',
            'Admin.AdminAction',
            'Autenticacao.ControleAcesso',
            'Gravatar.Gravatar',
            'Jquery.MaskedInput',
        );

        /**
         * Before filter
         */
        public function beforeFilter() {
            $this->setupAdmin();
            $this->setupControleAcesso();
        }

        /**
         * Inicializa opções exclusivas da rota admin
         */
        private function setupAdmin() {
            if ($this->request->param('admin')) {
                $this->layout = 'Admin.admin';
                $this->helpers['Html'] = array('className' => 'Bootstrap.BootstrapHtml');
                $this->helpers['Form'] = array('className' => 'Bootstrap.BootstrapForm');
            }
        }

        /**
         * Inicializa as configurações de controle de acesso
         */
        private function setupControleAcesso() {
            try {
                $this->ControleAcesso->config(array(
                    'prefixo_sessao' => 'LEAL',
                    'hashkey' => 'LEAL',
                    'pagina_login' => '/admin',
                    'pagina_logout' => '/admin',
                ));
                $this->ControleAcesso->restringir('admin');
                $this->ControleAcesso->verificar();
            } catch (ForbiddenException $e) {
                throw $e;
            }
        }

    }
    