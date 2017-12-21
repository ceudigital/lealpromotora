<?php

    /**
     * CoeficienteController
     *
     * @author Andre Araujo
     * 
     * @property Coeficiente $Coeficiente
     */
    class CoeficienteController extends LealAppController {

        /**
         * Lista de models
         * @var array
         */
        public $uses = array('Leal.Coeficiente');

        /**
         * Listagem de coeficientes
         */
        public function admin_index() {
            $this->PageTitle->add('Coeficientes');
            $this->Coeficiente->loadContains();
            $this->paginate = array(
                'limit' => 10,
                'order' => 'Coeficiente.tabela_id DESC, Coeficiente.prazo ASC',
            );
            $this->set('coeficientes', $this->paginate('Coeficiente'));
        }

        /**
         * Incluir um Coeficiente
         */
        public function admin_add() {
            $this->PageTitle->add('Coeficientes', 'Incluir');
            if ($this->request->is('post')) {
                if ($this->Coeficiente->save($this->request->data)) {
                    $this->Flash->success('Os dados foram gravados com sucesso.');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error('Ocorreram erros na validação dos dados.');
                }
            }
            $this->set('tabelas', $this->Coeficiente->Tabela->findList());
        }

        /**
         * Editar um Coeficiente
         * @param int $id ID do Coeficiente
         */
        public function admin_edit($id) {
            $this->PageTitle->add('Coeficientes', 'Editar');
            if ($this->request->is('put')) {
                if ($this->Coeficiente->save($this->request->data)) {
                    $this->Flash->success('Os dados foram gravados com sucesso.');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error('Ocorreram erros na validação dos dados.');
                }
            } else {
                $this->request->data = $this->Coeficiente->findById($id);
            }
            $this->set('tabelas', $this->Coeficiente->Tabela->findList());
        }

    }
    