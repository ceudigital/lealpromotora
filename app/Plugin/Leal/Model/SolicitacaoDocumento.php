<?php

    App::uses('SolicitacaoIncompletaException', 'Leal.Lib/Exception');

    /**
     * Description of SolicitacaoDocumento
     *
     * @author Andre Araujo
     * 
     * @property SolicitacaoTipoDocumento $SolicitacaoTipoDocumento
     * @property Solicitacao $Solicitacao
     */
    class SolicitacaoDocumento extends LealAppModel {

        /**
         * Nome da tabela
         * @var string
         */
        public $useTable = 'solicitacao_documento';

        /**
         * Behaviors
         * @var array 
         */
        public $actsAs = array(
            'Upload' => array(
                'arquivo' => array(
                    'folder' => '{ROOT}{DS}img{DS}{Model}',
                    'allowedMime' => array('image/jpeg', 'image/pjpeg', 'image/png'),
                    'allowedExt' => array('jpg', 'jpeg', 'png'),
                ),
            ),
            'ImageResize' => array(
                'arquivo' => array(
                    'folder' => '{ROOT}{DS}img{DS}{Model}',
                    'sizes' => array(
                        'default' => array('width' => 800),
                        'thumb' => array('width' => 150, 'height' => 150),
                    ),
                ),
            ),
        );

        /**
         * belongs to
         * @var array
         */
        public $belongsTo = array(
            'SolicitacaoTipoDocumento' => array(
                'className' => 'Leal.SolicitacaoTipoDocumento',
                'foreignKey' => 'solicitacao_tipo_documento_id',
            ),
            'Solicitacao' => array(
                'className' => 'Leal.Solicitacao',
                'foreignKey' => 'solicitacao_id',
            ),
        );

        /**
         * before save
         * - Remove outros registros associados a mesma solicitação e do mesmo tipo de documento
         * @param type $options
         * @return type
         */
        public function beforeSave($options = array()) {
            $conditions = array(
                'solicitacao_id' => $this->get('solicitacao_id'),
                'solicitacao_tipo_documento_id' => $this->get('solicitacao_tipo_documento_id'),
            );
            $this->deleteAll($conditions);
            return parent::beforeSave($options);
        }

        /**
         * Localiza um SolicitacaoDocumento pelo UUID da Solicitacao e ID do SolicitacaoTipoDocumento
         * @param string $uuid UUID da Solicitacao
         * @param int $solicitacao_tipo_documento_id ID do SolicitacaoTipoDocumento
         * @return array Dados do SolicitacaoDocumento
         */
        public function findyUuidAndSolicitacaoTipoDocumentoId($uuid, $solicitacao_tipo_documento_id) {
            $solicitacao = $this->Solicitacao->findByUUID($uuid);
            $this->Behaviors->attach('Containable');
            $contain = array('SolicitacaoTipoDocumento');
            $conditions = array(
                'solicitacao_id' => $solicitacao['Solicitacao']['id'],
                'solicitacao_tipo_documento_id' => $solicitacao_tipo_documento_id,
            );
            return $this->find('first', compact('contain', 'conditions'));
        }

        /**
         * 
         * @param string $uuid UUID da Solicitacao
         * @param int $solicitacao_tipo_documento_id ID do SolicitacaoTipoDocumento
         * @param array $data Array de dadoss
         * @return array Dados do SolicitacaoDocumento
         * @throws SolicitacaoConfirmadaException
         */
        public function incluir($uuid, $solicitacao_tipo_documento_id, $data) {
            //Recupera a Solicitacao pelo UUID
            $solicitacao = $this->Solicitacao->findByUUID($uuid);
            //Verifica se a solicitação pode ser alterada (não está confirmada)
            if (!$this->Solicitacao->isConfirmada($solicitacao['Solicitacao']['id'])) {
                throw new SolicitacaoIncompletaException();
            }
            $fieldList = array(
                'solicitacao_tipo_documento_id',
                'solicitacao_id',
                'arquivo',
                'confirmado'
            );
            $this->create($data);
            $this->set('solicitacao_id', $solicitacao['Solicitacao']['id']);
            $this->set('solicitacao_tipo_documento_id', $solicitacao_tipo_documento_id);
            $this->set('confirmado', false);
            return $this->save(null, true, $fieldList);
        }

        /**
         * Definir um SolicitacaoDocumento como confirmado
         * @param string $uuid UUID da Solicitacao
         * @param int $solicitacao_tipo_documento_id ID do SolicitacaoTipoDocumento
         * @param array $data Array de dadoss
         * @return array Dados do SolicitacaoDocumento
         * @throws SolicitacaoIncompletaException
         */
        public function confirmar($uuid, $solicitacao_tipo_documento_id) {
            //Recupera a Solicitacao pelo UUID
            $solicitacao = $this->Solicitacao->findByUUID($uuid);
            //Verifica se a solicitação pode ser alterada (não está confirmada)
            if (!$this->Solicitacao->isConfirmada($solicitacao['Solicitacao']['id'])) {
                throw new SolicitacaoIncompletaException();
            }
            $fieldList = array('confirmado');
            $solicitacaoDocumento = $this->findyUuidAndSolicitacaoTipoDocumentoId($uuid, $solicitacao_tipo_documento_id);
            $this->read(array('confirmado'), $solicitacaoDocumento['SolicitacaoDocumento']['id']);
            $this->set('confirmado', true);
            return $this->save(null, true, $fieldList);
        }

    }
    