<?php

    /**
     * SolicitacaoController
     *
     * @author Andre Araujo
     * 
     * @property Solicitacao $Solicitacao
     * @property SolicitacaoDocumento $SolicitacaoDocumento
     */
    class SolicitacaoController extends LealAppController {

        /**
         * Lista de nomes de models utilizados neste controller
         * @var array
         */
        public $uses = array(
            'Leal.Solicitacao',
            'Leal.SolicitacaoDocumento'
        );

        /**
         * Lista de helpers utilizados por este controller
         * @var array
         */
        public $helpers = array(
            'Leal.Solicitacao',
            'Leal.SolicitacaoView',
        );

        /**
         * Listagem de solicitações
         */
        public function admin_index() {
            $this->PageTitle->add('Solicitações');
            $this->Solicitacao->loadContains();
            $this->paginate = array(
                'conditions' => array(
                    'Solicitacao.etapa_1' => true,
                ),
                'limit' => 10,
                'order' => 'Solicitacao.created DESC',
            );
            $this->set('solicitacoes', $this->paginate('Solicitacao'));
        }

        /**
         * Visualização de uma solicitação
         * @param int $id ID da Solicitacoa
         */
        public function admin_view($id) {
            $this->PageTitle->add('Solicitações', 'Visualizar');
            $this->Solicitacao->read(array('uuid'), $id);
            $solicitacao = $this->Solicitacao->findByUUID($this->Solicitacao->get('uuid'));
            $this->request->data = $solicitacao;
            $this->set('solicitacao', $solicitacao);
        }

        /**
         * Preenchimento da solicitação - etapa 1 (dados pessoais)
         * @param string $uuid UUID da Solicitação
         */
        public function etapa_1($uuid) {
            try {
                $solicitacao = $this->Solicitacao->findByUUID($uuid);
                $this->PageTitle->add('Sobre você', 'Seus dados pessoais');
                if ($this->request->is('put')) {
                    if ($this->Solicitacao->salvarEtapa1($uuid, $this->request->data)) {
                        $this->redirect(array('action' => 'etapa_2', 'uuid' => $uuid));
                    } else {
                        $this->Flash->error('Alguns campos não foram preenchidos corretamente, verifique os erros abaixo.');
                    }
                } else {
                    DateConverter::ptbr($solicitacao['Solicitacao']['data_nascimento']);
                    $this->request->data = $solicitacao;
                }
                $this->set('estadoCivils', $this->Solicitacao->EstadoCivil->find('list'));
            } catch (SolicitacaoEtapaNaoPreenchidaException $ex) {
                $this->Flash->error($ex->getMessage());
                $this->redirect(array('action' => $ex->getEtapa(), 'uuid' => $uuid));
            } catch (CakeException $ex) {
                $this->Flash->error($ex->getMessage());
                $this->redirect('/');
            }
        }

        /**
         * Preenchimento da solicitação - etapa 2 (dados bancários)
         * @param string $uuid UUID da Solicitação
         */
        public function etapa_2($uuid) {
            try {
                $solicitacao = $this->Solicitacao->findByUUID($uuid);
                $this->Solicitacao->verificarPreenchimentoEtapa($solicitacao['Solicitacao']['id'], 'etapa_1');
                $this->PageTitle->add('Sobre você', 'Seus documentos');
                if ($this->request->is('put')) {
                    if ($this->Solicitacao->salvarEtapa2($uuid, $this->request->data)) {
                        $this->redirect(array('action' => 'etapa_3', 'uuid' => $uuid));
                    } else {
                        $this->Flash->error('Alguns campos não foram preenchidos corretamente, verifique os erros abaixo.');
                    }
                } else {
                    DateConverter::ptbr($solicitacao['Solicitacao']['rg_emissao_data']);
                    $this->request->data = $solicitacao;
                }
            } catch (SolicitacaoEtapaNaoPreenchidaException $ex) {
                $this->Flash->error($ex->getMessage());
                $this->redirect(array('action' => $ex->getEtapa(), 'uuid' => $uuid));
            } catch (CakeException $ex) {
                $this->Flash->error($ex->getMessage());
                $this->redirect('/');
            }
        }

        /**
         * Preenchimento da solicitação - etapa 3 (dados bancários)
         * @param string $uuid UUID da Solicitação
         */
        public function etapa_3($uuid) {
            try {
                $solicitacao = $this->Solicitacao->findByUUID($uuid);
                $this->Solicitacao->verificarPreenchimentoEtapa($solicitacao['Solicitacao']['id'], 'etapa_2');
                $this->PageTitle->add('Sobre você', 'Seus dados bancários');
                if ($this->request->is('put')) {
                    if ($this->Solicitacao->salvarEtapa3($uuid, $this->request->data)) {
                        $this->redirect(array('action' => 'confirmar_dados', 'uuid' => $uuid));
                    } else {
                        $this->Flash->error('Alguns campos não foram preenchidos corretamente, verifique os erros abaixo.');
                    }
                } else {
                    $this->request->data = $solicitacao;
                }
                $this->set('bancos', $this->Solicitacao->Banco->find('list'));
                $this->set('tipoContas', $this->Solicitacao->TipoConta->find('list'));
            } catch (SolicitacaoEtapaNaoPreenchidaException $ex) {
                $this->Flash->error($ex->getMessage());
                $this->redirect(array('action' => $ex->getEtapa(), 'uuid' => $uuid));
            } catch (CakeException $ex) {
                $this->Flash->error($ex->getMessage());
                $this->redirect('/');
            }
        }

        /**
         * Tela de confirma??o dos dados
         * @param string $uuid UUID da Solicitação
         */
        public function confirmar_dados($uuid) {
            try {
                $this->PageTitle->add('Sobre você', 'Confirme seus dados');
                $solicitacao = $this->Solicitacao->findByUUID($uuid);
                if (!$solicitacao) {
                    $this->Flash->error('Solicitação não encontrada ou já confirmada.');
                    $this->redirect('/');
                }
                if ($this->request->is('put')) {
                    if ($this->request->data['Solicitacao']['aceite_termos']) {
                        $this->Solicitacao->confirmar($uuid);
                        $this->redirect(array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'index', 'uuid' => $uuid));
                    } else {
                        $this->Flash->error('Voc? deve aceitar os termos de serviço para concluir sua solicitação.');
                    }
                }
                $this->request->data = $solicitacao;
            } catch (SolicitacaoIncompletaException $ex) {
                $this->Flash->error($ex->getMessage());
                $this->redirect(array('action' => 'etapa_1', 'uuid' => $uuid));
            } catch (CakeException $ex) {
                $this->Flash->error('<strong>Ocorreu um erro</strong> ' . $ex->getMessage());
            }
        }

        /**
         * Tela de confirma??o da solicitação
         */
        public function confirmacao($uuid) {
            $this->PageTitle->add('Solicitação realizada com sucesso!');
            $this->set('uuid', $uuid);
        }

    }
    