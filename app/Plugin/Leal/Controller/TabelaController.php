<?php

    App::uses('Data', 'Lib');

    /**
     * TabelaController
     *
     * @author Andre Araujo
     * 
     * @property Tabela $Tabela
     */
    class TabelaController extends LealAppController {

        /**
         * Lista de models
         * @var array
         */
        public $uses = array('Leal.Tabela');

        /**
         * Listagem de tabelas
         */
        public function admin_index() {
            $this->PageTitle->add('Tabelas');
            $this->Tabela->loadContains();
            $this->paginate = array(
                'limit' => 10,
                'order' => 'Tabela.vigencia_inicio DESC',
            );
            $this->set('tabelas', $this->paginate('Tabela'));
        }

        /**
         * Incluir um Tabela
         */
        public function admin_add() {
            $this->PageTitle->add('Tabelas', 'Incluir');
            if ($this->request->is('post')) {
                $this->Tabela->create($this->request->data);
                $this->Tabela->set('vigencia_inicio', Data::formatarISO($this->Tabela->get('vigencia_inicio')));
                $this->Tabela->set('vigencia_fim', Data::formatarISO($this->Tabela->get('vigencia_fim')));
                if ($this->Tabela->save()) {
                    $this->Flash->success('Os dados foram gravados com sucesso.');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error('Ocorreram erros na validação dos dados.');
                }
            }
            $this->set('orgaos', $this->Tabela->Orgao->find('list'));
        }

        /**
         * Editar um Tabela
         * @param int $id ID do Tabela
         */
        public function admin_edit($id) {
            $this->PageTitle->add('Tabelas', 'Editar');
            if ($this->request->is('put')) {
                $this->Tabela->create($this->request->data);
                $this->Tabela->set('vigencia_inicio', Data::formatarISO($this->Tabela->get('vigencia_inicio')));
                $this->Tabela->set('vigencia_fim', Data::formatarISO($this->Tabela->get('vigencia_fim')));
                if ($this->Tabela->save()) {
                    $this->Flash->success('Os dados foram gravados com sucesso.');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error('Ocorreram erros na validação dos dados.');
                }
            } else {
                $this->request->data = $this->Tabela->findById($id);
                $this->request->data['Tabela']['vigencia_inicio'] = Data::formatarPTBR($this->request->data['Tabela']['vigencia_inicio']);
                $this->request->data['Tabela']['vigencia_fim'] = Data::formatarPTBR($this->request->data['Tabela']['vigencia_fim']);
            }
            $this->set('orgaos', $this->Tabela->Orgao->find('list'));
        }

    }
    