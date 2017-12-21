<?php

    class AutenticacaoUsuario extends AutenticacaoAppModel {

        /**
         * Salt para definição do hash do usuário
         */
        const salt = 'YExqa3$mM&hD)iR@mgik8#_CLi9fC1g6eb%sz^qutdSt5ttlCC8!1L4LHiJWwhYe';

        /**
         * Nome da tabela no banco de dados
         * @var string
         */
        public $useTable = 'autenticacao_usuario';

        /**
         * Regras de valida??o
         * @var type 
         */
        public $validate = array(
            'nome' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Preencha o nome',
                ),
            ),
            'password' => array(
                'minLength' => array(
                    'rule' => array('minLength', 5),
                    'message' => 'Mínimo 5 caracteres',
                    'last' => true,
                ),
                'verificarConfirmacao' => array(
                    'rule' => 'verificarConfirmacao',
                    'message' => 'A confirmação da senha é diferente',
                    'last' => true,
                ),
            ),
            'email' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Preencha o e-mail',
                    'last' => true,
                ),
                'email' => array(
                    'rule' => array('email', false),
                    'message' => 'Endereço de e-mail inválido',
                    'allowEmpty' => true,
                    'last' => true,
                ),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Endereço de e-mail já cadastrado',
                ),
            ),
            'autenticacao_grupo_id' => array(
                'rule' => 'notEmpty',
                'message' => 'Grupo não informado',
            ),
        );

        /**
         * Relacionamentos 1:N lado N
         * @var array
         */
        public $belongsTo = array(
            'AutenticacaoGrupo' => array(
                'className' => 'Autenticacao.AutenticacaoGrupo',
                'counterCache' => true
            ),
        );

    }
    