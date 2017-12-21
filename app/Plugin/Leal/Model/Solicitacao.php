<?php

    App::uses('DateConverter', 'Lib');
    App::uses('Estado', 'Lib');
    App::uses('SolicitacaoTipoDocumento', 'Model');
    App::uses('SolicitacaoIncompletaException', 'Leal.Lib/Exception');
    App::uses('SolicitacaoConfirmadaException', 'Leal.Lib/Exception');
    App::uses('SolicitacaoEtapaNaoPreenchidaException', 'Leal.Lib/Exception');

    /**
     * Description of Solicitacao
     *
     * @author Andre Araujo
     * 
     * @property Coeficiente $Coeficiente
     * @property EstadoCivil $EstadoCivil
     * @property Banco $Banco
     * @property TipoConta $TipoConta
     * @property SolicitacaoDocumento $SolicitacaoDocumento
     */
    class Solicitacao extends LealAppModel {

        /**
         * Nome da tabela
         * @var array
         */
        public $useTable = 'solicitacao';

        /**
         * Behaviors
         * @var array 
         */
        public $actsAs = array(
            'DateFormat' => array(
                'fields' => array('data_nascimento', 'rg_emissao_data'),
            ),
        );

        /**
         * Campos virtuais
         * @var array
         */
        public $virtualFields = array(
            'conta_com_dv' => 'CONCAT(Solicitacao.conta,"-", Solicitacao.conta_dv)',
        );

        /**
         * Mapeamento de se��es/campos para cria��o dos virtual fields de 
         * verifica��o do preenchimento da solicita��o
         * Nome do virtualField deve ser igual ao m�todo onde os campos 
         * verificados s�o preenchidos em SimuladorController
         * @var array
         */
        private $virtualFieldsVerificacao = array(
            'etapa_1' => array('nome', 'telefone_fixo', 'telefone_celular', 'email'),
            'etapa_2' => array('sexo', 'data_nascimento', 'nome_mae', 'nome_pai', 'cep', 'endereco', 'numero', 'bairro', 'cidade', 'estado'),
            'etapa_3' => array('cpf', 'rg', 'rg_emissao_estado', 'rg_emissao_data', 'matricula_beneficio'),
            'etapa_4' => array('banco_id', 'tipo_conta_id', 'agencia', 'conta', 'conta_dv'),
        );

        /**
         * Valida��o
         * @var array
         */
        public $validate = array(
            'coeficiente_id' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                ),
            ),
            'estado_civil_id' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                ),
            ),
            'banco_id' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Selecione um item da lista',
                ),
            ),
            'tipo_conta_id' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Selecione um item da lista',
                ),
            ),
            'uuid' => array(
                'uuid' => array(
                    'rule' => 'uuid',
                    'message' => 'UUID inv�lido',
                ),
            ),
            'valor' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'naturalNumber' => array(
                    'rule' => 'naturalNumber',
                    'message' => 'Informe um valor inteiro',
                    'last' => true,
                ),
                'range' => array(
                    'rule' => array('range', 499, 100001),
                    'message' => 'Informe um valor entre R$ 500,00 e R$ 100.000,00',
                ),
            ),
            'nome' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                ),
            ),
            'email' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'email' => array(
                    'rule' => array('email', true),
                    'message' => 'O endere�o de e-mail informado n�o � v�lido',
                ),
            ),
            'telefone_fixo' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'regex' => array(
                    'rule' => '/^\(\d{2}\) \d{4,5}-\d{4}$/',
                    'message' => 'Informe o telefone no formato (99) 9999-9999 ou (99) 99999-9999',
                ),
            ),
            'telefone_celular' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'regex' => array(
                    'rule' => '/^\(\d{2}\) \d{4,5}-\d{4}$/',
                    'message' => 'Informe o telefone no formato (99) 9999-9999 ou (99) 99999-9999',
                ),
            ),
            'data_nascimento' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'date' => array(
                    'rule' => array('date', 'ymd'),
                    'message' => 'Informe uma data no formato dd/mm/aaaa',
                ),
            ),
            'sexo' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'inList' => array(
                    'rule' => array('inList', array('F', 'M')),
                    'message' => 'Informe feminino ou masculino',
                ),
            ),
            'nome_mae' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
            ),
            'nome_pai' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
            ),
            'cep' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'regex' => array(
                    'rule' => '/^\d{5}-\d{3}$/',
                    'message' => 'Informe o CEP no formato 99999-999',
                ),
            ),
            'endereco' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
            ),
            'numero' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
            ),
            'bairro' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
            ),
            'cidade' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
            ),
            'estado' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'inList' => array(
                    'rule' => array('inList', array('AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO')),
                    'message' => 'Selecione um item da lista',
                ),
            ),
            'cpf' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'regex' => array(
                    'rule' => '/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
                    'message' => 'O CPF informado n�o � v�lido',
                    'last' => true,
                ),
                'validarCPF' => array(
                    'rule' => 'validarCPF',
                    'message' => 'O CPF informado � inv�lido',
                ),
            ),
            'rg' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                ),
            ),
            'rg_emissao_estado' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                ),
                'inList' => array(
                    'rule' => array('inList', array('AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO')),
                    'message' => 'Selecione um item da lista',
                ),
            ),
            'rg_emissao_data' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'date' => array(
                    'rule' => array('date', 'ymd'),
                    'message' => 'Informe uma data no formato dd/mm/aaaa',
                ),
            ),
            'matricula_beneficio' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                ),
            ),
            'agencia' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'regex' => array(
                    'rule' => '/^\d+$/',
                    'message' => 'Informe somente n�meros',
                ),
            ),
            'conta' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'regex' => array(
                    'rule' => '/^\d+$/',
                    'message' => 'Informe somente n�meros',
                ),
            ),
            'conta_dv' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo � obrigat�rio',
                    'last' => true,
                ),
                'regex' => array(
                    'rule' => '/^([\d]+|[x])$/',
                    'message' => 'Informe somente n�meros ou X',
                ),
            ),
        );

        /**
         * belongs to
         * @var array
         */
        public $belongsTo = array(
            'Banco' => array(
                'className' => 'Leal.Banco',
            ),
            'Coeficiente' => array(
                'className' => 'Leal.Coeficiente',
            ),
            'EstadoCivil' => array(
                'className' => 'Leal.EstadoCivil',
            ),
            'TipoConta' => array(
                'className' => 'Leal.TipoConta',
            ),
        );

        /**
         * has one
         * @var array
         */
        public $hasOne = array(
            'DocumentoFrente' => array(
                'className' => 'Leal.SolicitacaoDocumento',
                'foreignKey' => 'solicitacao_id',
                'conditions' => 'DocumentoFrente.solicitacao_tipo_documento_id = 1',
            ),
            'DocumentoVerso' => array(
                'className' => 'Leal.SolicitacaoDocumento',
                'foreignKey' => 'solicitacao_id',
                'conditions' => 'DocumentoVerso.solicitacao_tipo_documento_id = 2',
            ),
            'DocumentoSelfie' => array(
                'className' => 'Leal.SolicitacaoDocumento',
                'foreignKey' => 'solicitacao_id',
                'conditions' => 'DocumentoSelfie.solicitacao_tipo_documento_id = 3',
            ),
            'DocumentoContracheque' => array(
                'className' => 'Leal.SolicitacaoDocumento',
                'foreignKey' => 'solicitacao_id',
                'conditions' => 'DocumentoContracheque.solicitacao_tipo_documento_id = 4',
            ),
            'DocumentoComprovanteResidencia' => array(
                'className' => 'Leal.SolicitacaoDocumento',
                'foreignKey' => 'solicitacao_id',
                'conditions' => 'DocumentoComprovanteResidencia.solicitacao_tipo_documento_id = 5',
            ),
        );

        /**
         * Callback beforeFind
         * @param type $query
         */
        public function beforeFind($query) {
            $this->createVirtualFieldsVerificacao();
            parent::beforeFind($query);
        }

        /**
         * Cria��o dos campos virtuais para verifica��o do preenchimento de cada 
         * uma das etapas da solicita��o
         */
        private function createVirtualFieldsVerificacao() {
            foreach ($this->virtualFieldsVerificacao as $name => $fields) {
                $sql = array();
                foreach ($fields as $field) {
                    $sql[] = sprintf('Solicitacao.%s IS NOT NULL', $field);
                }
                $this->virtualFields[$name] = implode(' AND ', $sql);
            }
        }

        /**
         * Retorna uma solicita��o e seus dados associados buscando pelo UUID. 
         * Somente solicita��es n�o confirmadas.
         * @param string $uuid UUID da Solicita��o
         * @return array Dados da solicita��o e models associados
         * @throws NotFoundException
         */
        public function findByUUID($uuid) {
            $this->loadContains();
            $conditions = array('Solicitacao.uuid' => $uuid);
            $solicitacao = $this->find('first', compact('contain', 'conditions'));
            if (!$solicitacao) {
                throw new NotFoundException();
            }
            if ($solicitacao) {
                //Calcula o valor da parcela para o coeficiente e valor informados
                $parcela = $this->Coeficiente->calcularParcela($solicitacao['Coeficiente']['id'], $solicitacao['Solicitacao']['valor']);
                $solicitacao['Solicitacao']['parcela'] = $parcela;
            }
            return $solicitacao;
        }

        /**
         * Carrega todas as associa��es via Containable
         */
        public function loadContains() {
            $this->Behaviors->load('Containable');
            $this->contain(array(
                'Banco',
                'Coeficiente' => array('Tabela' => array('Orgao')),
                'EstadoCivil',
                'TipoConta',
                'DocumentoFrente' => array('SolicitacaoTipoDocumento'),
                'DocumentoVerso' => array('SolicitacaoTipoDocumento'),
                'DocumentoSelfie' => array('SolicitacaoTipoDocumento'),
                'DocumentoContracheque' => array('SolicitacaoTipoDocumento'),
                'DocumentoComprovanteResidencia' => array('SolicitacaoTipoDocumento'),
            ));
        }

        /**
         * Salvar dados da etapa 1 de preenchimento da solicita��o (dados pessoais)
         * @param array $data Dados da solicita��o
         * @return mixed Array com dados da solicita��o ou false em caso de erro de grava��o
         * @throws SolicitacaoConfirmadaException
         * @throws SolicitacaoEtapaNaoPreenchidaException
         */
        public function salvarEtapa1($uuid, $data) {
            $fieldList = array('nome', 'telefone_fixo', 'telefone_celular', 'email', 'estado_civil_id', 'data_nascimento', 'sexo',
                'data_nascimento', 'nome_mae', 'nome_pai', 'cep', 'endereco',
                'numero', 'complemento', 'bairro', 'cidade', 'estado');
            return $this->_salvarEtapa($uuid, $data, $fieldList);
        }

        /**
         * Salvar dados da etapa 2 de preenchimento da solicita��o (documenta��o)
         * @param array $data Dados da solicita��o
         * @return mixed Array com dados da solicita��o ou false em caso de erro de grava��o
         * @throws SolicitacaoConfirmadaException
         * @throws SolicitacaoEtapaNaoPreenchidaException
         */
        public function salvarEtapa2($uuid, $data) {
            $fieldList = array('cpf', 'rg', 'rg_emissao_estado', 'rg_emissao_data', 'matricula_beneficio');
            return $this->_salvarEtapa($uuid, $data, $fieldList, 'etapa_1');
        }

        /**
         * Salvar dados da etapa 3 de preenchimento da solicita��o (dados banc�rios)
         * @param array $data Dados da solicita��o
         * @return mixed Array com dados da solicita��o ou false em caso de erro de grava��o
         * @throws SolicitacaoConfirmadaException
         * @throws SolicitacaoEtapaNaoPreenchidaException
         */
        public function salvarEtapa3($uuid, $data) {
            $fieldList = array('banco_id', 'agencia', 'conta', 'conta_dv', 'tipo_conta_id');
            return $this->_salvarEtapa($uuid, $data, $fieldList, 'etapa_2');
        }

        /**
         * Faz a confirma��o de uma solicita��o
         * @param string $uuid UUID da Solicita��o
         * @return array Dados da solicita��os
         * @throws NotFoundException Caso a solicita��o n�o seja encontrada ou j� esteja confirmada
         */
        public function confirmar($uuid) {
            $solicitacao = $this->findByUUID($uuid);
            if (!$this->isPreenchimentoCompleto($solicitacao['Solicitacao']['id'])) {
                throw new SolicitacaoIncompletaException();
            }
            if ($solicitacao) {
                $this->create($solicitacao);
                $this->set('aceite_termos', true);
                $solicitacao = $this->save(null, true, array('aceite_termos'));
            } else {
                throw new NotFoundException();
            }
            return $solicitacao;
        }

        /**
         * Informa se uma solicita��o pode ser confirmada
         * @param int $id ID da Solicita��o
         */
        public function isPreenchimentoCompleto($id) {
            $conditions = array(
                'Solicitacao.id' => $id,
                'Solicitacao.etapa_1' => true,
                'Solicitacao.etapa_2' => true,
                'Solicitacao.etapa_3' => true,
                'Solicitacao.etapa_4' => true,
            );
            return $this->hasAny($conditions);
        }

        /**
         * Informa se a solicita��o est� confirmada
         * @param int $id ID da Solicita��o
         * @return booelan
         */
        public function isConfirmada($id) {
            $conditions = array('id' => $id, 'aceite_termos' => true);
            return $this->hasAny($conditions);
        }

        /**
         * Informa se uma etapa do preechimento da solicita��o foi preenchida
         * @param int $id ID da Solicita��o
         * @param string $etapa Nome da etapa (nome de um dos virtual fields de verifica��o)
         * @return boolean True
         * @throws SolicitacaoEtapaNaoPreenchidaException
         */
        public function verificarPreenchimentoEtapa($id, $etapa) {
            $SolicitacaoDocumento = ClassRegistry::init('SolicitacaoDocumento');
            switch ($etapa) {
                case 'etapa_5';
                    $conditions = array(
                        'solicitacao_id' => $id,
                        'solicitacao_tipo_documento_id' => SolicitacaoTipoDocumento::FRENTE,
                    );
                    $result = $SolicitacaoDocumento->hasAny($conditions);
                    break;
                case 'etapa_6';
                    $conditions = array(
                        'solicitacao_id' => $id,
                        'solicitacao_tipo_documento_id' => SolicitacaoTipoDocumento::VERSO,
                    );
                    $result = $SolicitacaoDocumento->hasAny($conditions);
                    break;
                case 'etapa_7';
                    $conditions = array(
                        'solicitacao_id' => $id,
                        'solicitacao_tipo_documento_id' => SolicitacaoTipoDocumento::SELFIE,
                    );
                    $result = $SolicitacaoDocumento->hasAny($conditions);
                    break;
                default:
                    $conditions = array('id' => $id, $etapa => true);
                    $result = $this->hasAny($conditions);
            }
            if (!$result) {
                throw new SolicitacaoEtapaNaoPreenchidaException($etapa);
            }
            return true;
        }

        /**
         * Salvar os dados de uma solicita��o existente
         * @param array $data Dados da solicita��o
         * @param array $fieldList Lista de campos a serem salvos
         * @return mixed Dados da solicita��o ou false em caso de erro no salvamente
         * @throws NotFoundException
         * @throws SolicitacaoConfirmadaException
         * @throws SolicitacaoEtapaNaoPreenchidaException
         */
        private function _salvarEtapa($uuid, $data, $fieldList, $etapaAnterior = null) {
            //Recupera a Solicitacao pelo UUID
            $solicitacao = $this->findByUUID($uuid);
            //Verifica se a solicita��o pode ser alterada (n�o est� confirmada)
            if ($this->isConfirmada($solicitacao['Solicitacao']['id'])) {
                throw new SolicitacaoConfirmadaException();
            }
            //Verifica o preenchimento da etapa anterior se necess�rio
            if (!is_null($etapaAnterior)) {
                $this->verificarPreenchimentoEtapa($solicitacao['Solicitacao']['id'], $etapaAnterior);
            }
            //Carrega os dados da solicita��o
            $this->create($solicitacao);
            //Sobreescreve com as altera��es passadas pelo usu�rio
            $this->set($data);
            //Salva e retorna
            return $this->save(null, true, $fieldList);
        }

    }
    