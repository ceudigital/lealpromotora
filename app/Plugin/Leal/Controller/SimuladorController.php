<?php

    App::uses('DateConverter', 'Lib');

    /**
     * Description of SimuladorController
     *
     * @author Andre Araujo
     * 
     * @property Orgao $Orgao
     * @property Solicitacao $Solicitacao
     * 
     */
    class SimuladorController extends LealAppController {

        /**
         * Lista de nomes de models utilizados neste controller
         * @var array
         */
        public $uses = array(
            'Leal.Orgao',
            'Leal.Solicitacao'
        );

        /**
         * Lista de nomes de helpers utilizados neste controller
         * @var array
         */
        public $helpers = array(
            'Number',
            'FieldMask',
            'Leal.Simulador',
            'Leal.Confirmacao',
        );

        /**
         * Tela inicial do simulador
         */
        public function index() {
            if (isset($this->request->query['utm_source'])) {
                $utm_source = $this->request->query['utm_source'];
                if (isset($this->request->query['utm_campaign'])) {
                    $utm_campaign = $this->request->query['utm_campaign'];
                } else {
                    $utm_campaign = 'Não informado';
                }
            } else {
                $utm_source = 'Não informado';
                $utm_campaign = 'Não informado';
            }
            $this->Session->write('utm_source', $utm_source);
            $this->Session->write('utm_campaign', $utm_campaign);
            $this->PageTitle->add('Qual valor você precisa?', 'Simulador de Empréstimo');
            if ($this->request->is('post')) {
                $orgao = $this->Orgao->findById($this->request->data['Solicitacao']['orgao_id']);
                $this->Solicitacao->create($this->request->data);
                $this->Solicitacao->set('valor', str_replace('.', '', $this->Solicitacao->get('valor')));
                $validates = $this->Solicitacao->validates();
                if ($orgao && $validates) {
                    $this->redirect(array(
                        'action' => 'prazo',
                        'orgao' => $orgao['Orgao']['slug'],
                        'valor' => $this->Solicitacao->get('valor'),
                    ));
                } else {
                    if (!$orgao) {
                        $this->Solicitacao->invalidate('orgao_id', 'Selecione um item na lista');
                    }
                    $this->Flash->error('Por favor, informe o convênio e o valor desejado');
                }
            }
            $orgaos = $this->Orgao->findListTabelaAtiva();
            $this->set(compact('orgaos'));
        }

        /**
         * Simulação
         * @param string $orgao_slug Slug do orgao
         * @param int $valor Valor solicitado
         */
        public function prazo($orgao_slug, $valor) {
            $this->Solicitacao->create();
            $this->Solicitacao->set('valor', $valor);
            if (!$this->Solicitacao->validates()) {
                $this->Flash->error('Solicitação inválida, por favor informe seus dados novamente.');
                $this->redirect(array('action' => 'index'));
            }
            $orgao = $this->Orgao->findBySlug($orgao_slug);
            $tabela = $this->Orgao->Tabela->simular($orgao['Orgao']['id'], $valor);
            $this->PageTitle->add(CakeNumber::currency($valor, 'BRL'), $orgao['Orgao']['descricao']);
            if ($this->request->is('post')) {
                $this->Solicitacao->create($this->request->data);
                $this->Solicitacao->set('uuid', CakeText::uuid());
                $this->Solicitacao->set('valor', $valor);
                $this->Solicitacao->set('aceite_termos', false);
                $this->Solicitacao->set('ip', $_SERVER['REMOTE_ADDR']);
                $this->Solicitacao->set('utm_source', $this->Session->read('utm_source'));
                $this->Solicitacao->set('utm_campaign', $this->Session->read('utm_campaign'));
                $fieldList = array('nome', 'telefone_fixo', 'email', 'coeficiente_id', 'uuid', 'valor', 'aceite_termos', 'utm_source', 'utm_campaign', 'ip');
                $solicitacao = $this->Solicitacao->save(null, true, $fieldList);
                if ($solicitacao !== false) {
                    $url = array(
                        'controller' => 'solicitacao',
                        'action' => 'etapa_1',
                        'uuid' => $solicitacao['Solicitacao']['uuid'],
                    );
                    $this->redirect($url);
                } else {
                    $this->Flash->error('Foram encontrados erros no preenchimento das informações, por favor, verifique-os e tente novamente.');
                }
            }
            $this->set(compact('orgao', 'tabela', 'valor'));
        }

    }
    