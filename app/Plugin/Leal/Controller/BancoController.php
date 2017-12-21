<?php

    /**
     * BancoController
     *
     * @author Andre Araujo
     * 
     * @property Banco $Banco
     */
    class BancoController extends LealAppController {

        /**
         * Lista de models
         * @var array
         */
        public $uses = array('Leal.Banco');

        /**
         * Lista de helpers utilizados por este controller
         * @var array
         */
        public $helpers = array('Leal.Banco');

        /**
         * Listagem de bancos
         */
        public function admin_index() {
            $this->PageTitle->add('Bancos');
            $this->paginate = array(
                'limit' => 10,
                'order' => 'Banco.descricao ASC',
            );
            $this->set('bancos', $this->paginate('Banco'));
        }

        /**
         * Incluir um Banco
         */
        public function admin_add() {
            $this->PageTitle->add('Bancos', 'Incluir');
            if ($this->request->is('post')) {
                if ($this->Banco->save($this->request->data)) {
                    $this->Flash->success('Os dados foram gravados com sucesso.');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error('Ocorreram erros na validação dos dados.');
                }
            }
        }

        /**
         * Editar um Banco
         * @param int $id ID do Banco
         */
        public function admin_edit($id) {
            $this->PageTitle->add('Bancos', 'Editar');
            if ($this->request->is('put')) {
                if ($this->Banco->save($this->request->data)) {
                    $this->Flash->success('Os dados foram gravados com sucesso.');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error('Ocorreram erros na validação dos dados.');
                }
            } else {
                $this->request->data = $this->Banco->findById($id);
            }
        }

    }
    