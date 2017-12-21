<?php

    /**
     * OrgaoController
     *
     * @author Andre Araujo
     * 
     * @property Orgao $Orgao
     */
    class OrgaoController extends LealAppController {

        /**
         * Lista de models
         * @var array
         */
        public $uses = array('Leal.Orgao');

        /**
         * Lista de helpers utilizados por este controller
         * @var array
         */
        public $helpers = array('Leal.Orgao');

        /**
         * Listagem de órgãos
         */
        public function admin_index() {
            $this->PageTitle->add('Órgãos');
            $this->paginate = array(
                'limit' => 10,
                'order' => 'Orgao.descricao ASC',
            );
            $this->set('orgaos', $this->paginate('Orgao'));
        }

        /**
         * Incluir um Orgao
         */
        public function admin_add() {
            $this->PageTitle->add('Órgãos', 'Incluir');
            if ($this->request->is('post')) {
                if ($this->Orgao->save($this->request->data)) {
                    $this->Flash->success('Os dados foram gravados com sucesso.');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error('Ocorreram erros na validação dos dados.');
                }
            }
        }

        /**
         * Editar um Orgao
         * @param int $id ID do Orgao
         */
        public function admin_edit($id) {
            $this->PageTitle->add('Órgãos', 'Editar');
            if ($this->request->is('put')) {
                if ($this->Orgao->save($this->request->data)) {
                    $this->Flash->success('Os dados foram gravados com sucesso.');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error('Ocorreram erros na validação dos dados.');
                }
            } else {
                $this->request->data = $this->Orgao->findById($id);
            }
        }

    }
    