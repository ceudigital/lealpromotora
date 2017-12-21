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
         * Mapeamento de seções/campos para criação dos virtual fields de 
         * verificação do preenchimento da solicitação
         * Nome do virtualField deve ser igual ao método onde os campos 
         * verificados são preenchidos em SimuladorController
         * @var array
         */
        private $virtualFieldsVerificacao = array(
            'etapa_1' => array('nome', 'telefone_fixo', 'telefone_celular', 'email'),
            'etapa_2' => array('sexo', 'data_nascimento', 'nome_mae', 'nome_pai', 'cep', 'endereco', 'numero', 'bairro', 'cidade', 'estado'),
            'etapa_3' => array('cpf', 'rg', 'rg_emissao_estado', 'rg_emissao_data', 'matricula_beneficio'),
            'etapa_4' => array('banco_id', 'tipo_conta_id', 'agencia', 'conta', 'conta_dv'),
        );

        /**
         * Validação
         * @var array
         */
        public $validate = array(
            'coeficiente_id' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
                ),
            ),
            'estado_civil_id' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
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
                    'message' => 'UUID inválido',
                ),
            ),
            'valor' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
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
                    'message' => 'Este campo é obrigatório',
                ),
            ),
            'email' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
                    'last' => true,
                ),
                'email' => array(
                    'rule' => array('email', true),
                    'message' => 'O endereço de e-mail informado não é válido',
                ),
            ),
            'telefone_fixo' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
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
                    'message' => 'Este campo é obrigatório',
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
                    'message' => 'Este campo é obrigatório',
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
                    'message' => 'Este campo é obrigatório',
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
                    'message' => 'Este campo é obrigatório',
                    'last' => true,
                ),
            ),
            'nome_pai' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
                    'last' => true,
                ),
            ),
            'cep' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
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
                    'message' => 'Este campo é obrigatório',
                    'last' => true,
                ),
            ),
            'numero' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
                    'last' => true,
                ),
            ),
            'bairro' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
                    'last' => true,
                ),
            ),
            'cidade' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
                    'last' => true,
                ),
            ),
            'estado' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
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
                    'message' => 'Este campo é obrigatório',
                    'last' => true,
                ),
                'regex' => array(
                    'rule' => '/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
                    'message' => 'O CPF informado não é válido',
                    'last' => true,
                ),
                'validarCPF' => array(
                    'rule' => 'validarCPF',
                    'message' => 'O CPF informado é inválido',
                ),
            ),
            'rg' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
                ),
            ),
            'rg_emissao_estado' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
                ),
                'inList' => array(
                    'rule' => array('inList', array('AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO')),
                    'message' => 'Selecione um item da lista',
                ),
            ),
            'rg_emissao_data' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
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
                    'message' => 'Este campo é obrigatório',
                ),
            ),
            'agencia' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
                    'last' => true,
                ),
                'regex' => array(
                    'rule' => '/^\d+$/',
                    'message' => 'Informe somente números',
                ),
            ),
            'conta' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
                    'last' => true,
                ),
                'regex' => array(
                    'rule' => '/^\d+$/',
                    'message' => 'Informe somente números',
                ),
            ),
            'conta_dv' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Este campo é obrigatório',
                    'last' => true,
                ),
                'regex' => array(
                    'rule' => '/^([\d]+|[x])$/',
                    'message' => 'Informe somente números ou X',
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
         * Criação dos campos virtuais para verificação do preenchimento de cada 
         * uma das etapas da solicitação
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
         * Retorna uma solicitação e seus dados associados buscando pelo UUID. 
         * Somente solicitações não confirmadas.
         * @param string $uuid UUID da Solicitação
         * @return array Dados da solicitação e models associados
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
         * Carrega todas as associações via Containable
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
         * Salvar dados da etapa 1 de preenchimento da solicitação (dados pessoais)
         * @param array $data Dados da solicitação
         * @return mixed Array com dados da solicitação ou false em caso de erro de gravação
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
         * Salvar dados da etapa 2 de preenchimento da solicitação (documentação)
         * @param array $data Dados da solicitação
         * @return mixed Array com dados da solicitação ou false em caso de erro de gravação
         * @throws SolicitacaoConfirmadaException
         * @throws SolicitacaoEtapaNaoPreenchidaException
         */
        public function salvarEtapa2($uuid, $data) {
            $fieldList = array('cpf', 'rg', 'rg_emissao_estado', 'rg_emissao_data', 'matricula_beneficio');
            return $this->_salvarEtapa($uuid, $data, $fieldList, 'etapa_1');
        }

        /**
         * Salvar dados da etapa 3 de preenchimento da solicitação (dados bancários)
         * @param array $data Dados da solicitação
         * @return mixed Array com dados da solicitação ou false em caso de erro de gravação
         * @throws SolicitacaoConfirmadaException
         * @throws SolicitacaoEtapaNaoPreenchidaException
         */
        public function salvarEtapa3($uuid, $data) {
            $fieldList = array('banco_id', 'agencia', 'conta', 'conta_dv', 'tipo_conta_id');
            return $this->_salvarEtapa($uuid, $data, $fieldList, 'etapa_2');
        }

        /**
         * Faz a confirmação de uma solicitação
         * @param string $uuid UUID da Solicitação
         * @return array Dados da solicitaçãos
         * @throws NotFoundException Caso a solicitação não seja encontrada ou já esteja confirmada
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
         * Informa se uma solicitação pode ser confirmada
         * @param int $id ID da Solicitação
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
         * Informa se a solicitação está confirmada
         * @param int $id ID da Solicitação
         * @return booelan
         */
        public function isConfirmada($id) {
            $conditions = array('id' => $id, 'aceite_termos' => true);
            return $this->hasAny($conditions);
        }

        /**
         * Informa se uma etapa do preechimento da solicitação foi preenchida
         * @param int $id ID da Solicitação
         * @param string $etapa Nome da etapa (nome de um dos virtual fields de verificação)
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
         * Salvar os dados de uma solicitação existente
         * @param array $data Dados da solicitação
         * @param array $fieldList Lista de campos a serem salvos
         * @return mixed Dados da solicitação ou false em caso de erro no salvamente
         * @throws NotFoundException
         * @throws SolicitacaoConfirmadaException
         * @throws SolicitacaoEtapaNaoPreenchidaException
         */
        private function _salvarEtapa($uuid, $data, $fieldList, $etapaAnterior = null) {
            //Recupera a Solicitacao pelo UUID
            $solicitacao = $this->findByUUID($uuid);
            //Verifica se a solicitação pode ser alterada (não está confirmada)
            if ($this->isConfirmada($solicitacao['Solicitacao']['id'])) {
                throw new SolicitacaoConfirmadaException();
            }
            //Verifica o preenchimento da etapa anterior se necessário
            if (!is_null($etapaAnterior)) {
                $this->verificarPreenchimentoEtapa($solicitacao['Solicitacao']['id'], $etapaAnterior);
            }
            //Carrega os dados da solicitação
            $this->create($solicitacao);
            //Sobreescreve com as alterações passadas pelo usuário
            $this->set($data);
            //Salva e retorna
            return $this->save(null, true, $fieldList);
        }

    }
    