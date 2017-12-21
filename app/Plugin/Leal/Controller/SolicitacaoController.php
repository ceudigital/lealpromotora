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
         * Listagem de solicita��es
         */
        public function admin_index() {
            $this->PageTitle->add('Solicita��es');
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
         * Visualiza��o de uma solicita��o
         * @param int $id ID da Solicitacoa
         */
        public function admin_view($id) {
            $this->PageTitle->add('Solicita��es', 'Visualizar');
            $this->Solicitacao->read(array('uuid'), $id);
            $solicitacao = $this->Solicitacao->findByUUID($this->Solicitacao->get('uuid'));
            $this->request->data = $solicitacao;
            $this->set('solicitacao', $solicitacao);
        }

        /**
         * Preenchimento da solicita��o - etapa 1 (dados pessoais)
         * @param string $uuid UUID da Solicita��o
         */
        public function etapa_1($uuid) {
            try {
                $solicitacao = $this->Solicitacao->findByUUID($uuid);
                $this->PageTitle->add('Sobre voc�', 'Seus dados pessoais');
                if ($this->request->is('put')) {
                    if ($this->Solicitacao->salvarEtapa1($uuid, $this->request->data)) {
                        $this->redirect(array('action' => 'etapa_2', 'uuid' => $uuid));
                    } else {
                        $this->Flash->error('Alguns campos n�o foram preenchidos corretamente, verifique os erros abaixo.');
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
         * Preenchimento da solicita��o - etapa 2 (dados banc�rios)
         * @param string $uuid UUID da Solicita��o
         */
        public function etapa_2($uuid) {
            try {
                $solicitacao = $this->Solicitacao->findByUUID($uuid);
                $this->Solicitacao->verificarPreenchimentoEtapa($solicitacao['Solicitacao']['id'], 'etapa_1');
                $this->PageTitle->add('Sobre voc�', 'Seus documentos');
                if ($this->request->is('put')) {
                    if ($this->Solicitacao->salvarEtapa2($uuid, $this->request->data)) {
                        $this->redirect(array('action' => 'etapa_3', 'uuid' => $uuid));
                    } else {
                        $this->Flash->error('Alguns campos n�o foram preenchidos corretamente, verifique os erros abaixo.');
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
         * Preenchimento da solicita��o - etapa 3 (dados banc�rios)
         * @param string $uuid UUID da Solicita��o
         */
        public function etapa_3($uuid) {
            try {
                $solicitacao = $this->Solicitacao->findByUUID($uuid);
                $this->Solicitacao->verificarPreenchimentoEtapa($solicitacao['Solicitacao']['id'], 'etapa_2');
                $this->PageTitle->add('Sobre voc�', 'Seus dados banc�rios');
                if ($this->request->is('put')) {
                    if ($this->Solicitacao->salvarEtapa3($uuid, $this->request->data)) {
                        $this->redirect(array('action' => 'confirmar_dados', 'uuid' => $uuid));
                    } else {
                        $this->Flash->error('Alguns campos n�o foram preenchidos corretamente, verifique os erros abaixo.');
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
         * @param string $uuid UUID da Solicita��o
         */
        public function confirmar_dados($uuid) {
            try {
                $this->PageTitle->add('Sobre voc�', 'Confirme seus dados');
                $solicitacao = $this->Solicitacao->findByUUID($uuid);
                if (!$solicitacao) {
                    $this->Flash->error('Solicita��o n�o encontrada ou j� confirmada.');
                    $this->redirect('/');
                }
                if ($this->request->is('put')) {
                    if ($this->request->data['Solicitacao']['aceite_termos']) {
                        $this->Solicitacao->confirmar($uuid);
                        $this->redirect(array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'index', 'uuid' => $uuid));
                    } else {
                        $this->Flash->error('Voc? deve aceitar os termos de servi�o para concluir sua solicita��o.');
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
         * Tela de confirma??o da solicita��o
         */
        public function confirmacao($uuid) {
            $this->PageTitle->add('Solicita��o realizada com sucesso!');
            $this->set('uuid', $uuid);
        }

    }
    