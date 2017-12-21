<?php

   class AutenticacaoGrupo extends AutenticacaoAppModel {

      /**
       * Nome da tabela no banco de dados
       * @var string
       */
      public $useTable = 'autenticacao_grupo';

      /**
       * Campo de exibi��o
       * @var string
       */
      public $displayField = 'descricao';

      /**
       * Regras de valida��o
       * @var array
       */
      public $validate = array(
         'descricao' => array(
            'notEmpty' => array(
               'rule' => 'notEmpty',
               'message' => 'Descri��o n�o pode ser vazio',
            ),
            'isUnique' => array(
               'rule' => 'isUnique',
               'message' => 'O grupo j� est� cadastrado',
            ),
         ),
      );

      /**
       * Relacionamentos 1:N lado 1
       * @var array
       */
      public $hasMany = array(
         'AutenticacaoUsuario' => array(
            'className' => 'Autenticacao.AutenticacaoUsuario',
            'foreignKey' => 'autenticacao_grupo_id',
         ),
      );

      /**
       * Relacionamentos N:M
       * @var array
       */
      public $hasAndBelongsToMany = array(
         'AutenticacaoPermissao' => array(
            'className' => 'Autenticacao.AutenticacaoPermissao',
            'joinTable' => 'autenticacao_grupo_autenticacao_permissao',
            'dependent' => false,
         )
      );

      /**
       * Callback chamado antes da a��o de delete do model, sempre retorna false
       * para n�o permitir exclus�o de registros
       * @return boolean False
       */
      function beforeDelete($cascade=true) {
         return false;
      }

   }