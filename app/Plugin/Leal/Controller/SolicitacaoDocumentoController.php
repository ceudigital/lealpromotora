<?php

    /**
     * Description of SolicitacaoDocumentoController
     *
     * @author Andre Araujo
     * 
     * @property Solicitacao $Solicitacao
     * @property SolicitacaoDocumento $SolicitacaoDocumento
     * @property SolicitacaoTipoDocumento $SolicitacaoTipoDocumento
     */
    class SolicitacaoDocumentoController extends LealAppController {

        /**
         * Lista de nomes de models utilizados por este controler
         * @var array
         */
        public $uses = array(
            'Leal.Solicitacao',
            'Leal.SolicitacaoDocumento',
            'Leal.SolicitacaoTipoDocumento',
        );

        public function index($uuid) {
            try {
                //Recupera a solicitação
                $solicitacao = $this->Solicitacao->findByUUID($uuid);
                //Verifica se a solicitação está confirmada
                if (!$this->Solicitacao->isConfirmada($solicitacao['Solicitacao']['id'])) {
                    $this->Flash->error('Favor preencher os dados da solicitação corretamente.');
                    $this->redirect(array('controller' => 'solicitacao', 'action' => 'etapa_1', 'uuid' => $uuid));
                }
                //Carrega os tipos de documento
                $this->SolicitacaoTipoDocumento->Behaviors->load('Containable');
                $contain = array(
                    'SolicitacaoDocumento' => array(
                        'conditions' => array(
                            'SolicitacaoDocumento.solicitacao_id' => $solicitacao['Solicitacao']['id'],
                        ),
                    ),
                );
                $solicitacaoTipoDocumentos = $this->SolicitacaoTipoDocumento->find('all', compact('contain'));
                $this->set(compact('uuid', 'solicitacaoTipoDocumentos', 'solicitacao'));
            } catch (Exception $ex) {
                $this->Flash->error($ex->getMessage());
                $this->redirect('/');
            }
        }

        public function add($uuid, $solicitacao_tipo_documento_id) {
            try {
                if ($this->request->is('post')) {
                    if ($this->SolicitacaoDocumento->incluir($uuid, $solicitacao_tipo_documento_id, $this->request->data)) {
                        $this->redirect(array('action' => 'confirmar', 'uuid' => $uuid, $solicitacao_tipo_documento_id));
                    } else {
                        $this->Flash->error('Ocorreu um erro ao enviar a imagem, por favor tente novamente');
                    }
                }
                $solicitacaoTipoDocumento = $this->SolicitacaoTipoDocumento->findById($solicitacao_tipo_documento_id);
                $this->set(compact('uuid', 'solicitacaoTipoDocumento'));
            } catch (SolicitacaoIncompletaException $ex) {
                $this->Flash->error($ex->getMessage());
                $this->redirect(array('controller' => 'solicitacao', 'action' => 'etapa_1', 'uuid' => $uuid));
            } catch (Exception $ex) {
                $this->Flash->error($ex->getMessage());
                $this->redirect('/');
            }
        }

        public function confirmar($uuid, $solicitacao_tipo_documento_id) {
            try {
                if ($this->request->is('post')) {
                    if ($this->SolicitacaoDocumento->confirmar($uuid, $solicitacao_tipo_documento_id)) {
                        $this->redirect(array('action' => 'index', 'uuid' => $uuid));
                    } else {
                        $this->Flash->error('Ocorreu um erro ao realizar a confirmação da imagem, por favor tente novamente');
                    }
                }
                $solicitacaoDocumento = $this->SolicitacaoDocumento->findyUuidAndSolicitacaoTipoDocumentoId($uuid, $solicitacao_tipo_documento_id);
                $this->set(compact('uuid', 'solicitacaoDocumento'));
            } catch (SolicitacaoIncompletaException $ex) {
                $this->Flash->error($ex->getMessage());
                $this->redirect(array('controller' => 'solicitacao', 'action' => 'etapa_1', 'uuid' => $uuid));
            } catch (Exception $ex) {
                $this->Flash->error($ex->getMessage());
                $this->redirect('/');
            }
        }

    }
    