<?php

    /**
     * AutenticacaoUsuariosController
     * 
     * @property ControleAcessoComponent $ControleAcesso
     */
    class AutenticacaoUsuariosController extends AutenticacaoAppController {

        /**
         * beforeRender 
         */
        public function beforeRender() {
            parent::beforeRender();
            $this->set('autenticacaoGrupos', $this->AutenticacaoUsuario->AutenticacaoGrupo->find('list'));
        }

        /**
         * Autenticação de usuário no sistema
         */
        public function login() {
            $this->layout = 'Admin.login';
            $this->PageTitle->add('Entrar');
            if ($this->ControleAcesso->usuario('id')) {
                $this->redirect($this->ControleAcesso->grupo('redirecionar'));
            }
            if ($this->request->is('post')) {
                try {
                    $this->ControleAcesso->login($this->params['data']['AutenticacaoUsuario']);
                } catch (CakeException $e) {
                    $this->Flash->error($e->getMessage());
                }
            }
        }

        /**
         * Efetua o logout do usu?rio do sistema e redireciona para a p?gina
         * de login informando o usu?rio que a sess?o foi encerrada. 
         */
        public function logout() {
            $this->ControleAcesso->logout();
        }

        /**
         * acesso_negado
         */
        public function acesso_negado() {
            $this->layout = 'admin';
        }

        /**
         * admin_index
         */
        public function admin_index() {
            $this->AutenticacaoUsuario->Behaviors->attach('Containable');
            $this->paginate = array(
                'contain' => array('AutenticacaoGrupo'),
            );
            $usuarios = $this->paginate();
            $this->set(compact('usuarios'));
        }

        /**
         * admin_add
         */
        public function admin_add() {
            if (!empty($this->request->data)) {
                $this->AutenticacaoUsuario->create($this->request->data);
                if ($this->AutenticacaoUsuario->validates()) {
                    $this->request->data['AutenticacaoUsuario']['password'] = sha1($this->request->data['AutenticacaoUsuario']['password']);
                    if ($this->AutenticacaoUsuario->save($this->request->data, false)) {
                        $this->alerta('Salvo com sucesso');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        $this->alerta('Erro na gravação');
                    }
                } else {
                    $this->alerta('Não foi possível salvar, corrija os erros indicados abaixo.');
                }
            }
            $this->set('authGrupos', $this->AutenticacaoUsuario->AutenticacaoGrupo->find('list'));
        }

        /**
         * admin_edit
         * @param type $id
         * @throws NotFoundException 
         */
        public function admin_edit($id = null) {
            if (!$this->AutenticacaoUsuario->exists($id)) {
                throw new NotFoundException();
            }
            if (!empty($this->request->data)) {
                //Alterar dados se senha
                if (!empty($this->request->data['AutenticacaoUsuario']['password'])) {
                    $this->AutenticacaoUsuario->create($this->request->data);
                    if ($this->AutenticacaoUsuario->validates()) {
                        $this->request->data['AutenticacaoUsuario']['password'] = sha1($this->request->data['AutenticacaoUsuario']['password']);
                        if ($this->AutenticacaoUsuario->save($this->request->data, false)) {
                            unset($this->request->data['AutenticacaoUsuario']['password']);
                            unset($this->request->data['AutenticacaoUsuario']['passwd_confirm']);
                            $this->alerta('Dados atualizados');
                            $this->redirect(array('action' => 'index'));
                        } else {
                            $this->alerta('Erro na gravação');
                        }
                    } else {
                        $this->alerta('Não foi possível salvar, corrija os erros indicados abaixo');
                    }
                    //Alterar somente dados
                } else {
                    unset($this->request->data['AutenticacaoUsuario']['password']);
                    if ($this->AutenticacaoUsuario->save($this->request->data)) {
                        $this->alerta('Dados atualizados');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        $this->alerta('Erro, tente novamente');
                    }
                }
            } else {
                $this->request->data = $this->AutenticacaoUsuario->read(null, $id);
                unset($this->request->data['AutenticacaoUsuario']['password']);
            }
            $this->set('authGrupos', $this->AutenticacaoUsuario->AutenticacaoGrupo->find('list'));
        }

        /**
         * Alterar os dados do usuario ativo
         */
        public function admin_meus_dados() {
            $id = $this->ControleAcesso->usuario('id');
            if (!empty($this->request->data)) {
                //Alterar dados se senha
                if (!empty($this->request->data['AutenticacaoUsuario']['password'])) {
                    $this->AutenticacaoUsuario->create($this->request->data);
                    if ($this->AutenticacaoUsuario->validates()) {
                        $this->request->data['AutenticacaoUsuario']['password'] = sha1($this->request->data['AutenticacaoUsuario']['password']);
                        if ($this->AutenticacaoUsuario->save($this->request->data, false)) {
                            unset($this->request->data['AutenticacaoUsuario']['password']);
                            unset($this->request->data['AutenticacaoUsuario']['passwd_confirm']);
                            $this->alerta('Dados atualizados');
                        } else {
                            $this->alerta('Erro ao salvar, tente novamente');
                        }
                    } else {
                        $this->alerta('Não foi possível salvar, corrija os erros indicados abaixo');
                    }
                    //Alterar somente dados
                } else {
                    unset($this->request->data['AutenticacaoUsuario']['password']);
                    if ($this->AutenticacaoUsuario->save($this->request->data)) {
                        $this->alerta('Dados atualizados');
                    } else {
                        $this->alerta('Erro, tente novamente');
                    }
                }
            } else {
                $this->request->data = $this->AutenticacaoUsuario->read(null, $id);
                unset($this->request->data['AutenticacaoUsuario']['password']);
            }
        }

    }
    