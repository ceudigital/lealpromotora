<?php

   class AutenticacaoGrupo extends AutenticacaoAppModel {

      /**
       * Nome da tabela no banco de dados
       * @var string
       */
      public $useTable = 'autenticacao_grupo';

      /**
       * Campo de exibição
       * @var string
       */
      public $displayField = 'descricao';

      /**
       * Regras de validação
       * @var array
       */
      public $validate = array(
         'descricao' => array(
            'notEmpty' => array(
               'rule' => 'notEmpty',
               'message' => 'Descrição não pode ser vazio',
            ),
            'isUnique' => array(
               'rule' => 'isUnique',
               'message' => 'O grupo já está cadastrado',
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
       * Callback chamado antes da ação de delete do model, sempre retorna false
       * para não permitir exclusão de registros
       * @return boolean False
       */
      function beforeDelete($cascade=true) {
         return false;
      }

   }