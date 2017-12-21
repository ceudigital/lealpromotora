<?php

class AutenticacaoPermissao extends AutenticacaoAppModel {

    /**
     * Nome da tabela no banco de dados
     * @var string
     */
    public $useTable = 'autenticacao_permissao';

    /**
     * Ordem
     * @var string
     */
    public $order = 'AutenticacaoPermissao.titulo ASC';

    /**
     * Regras de validação
     * @var array
     */
    public $validate = array(
        'titulo' => array(
            'rule' => 'notEmpty',
            'message' => 'Informe o título',
        ),
        'descricao' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Informe a permissão',
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Permissão já existe',
            ),
        ),
    );

    /**
     * Relacionamentos N:M
     * @var array 
     */
    public $hasAndBelongsToMany = array(
        'AutenticacaoGrupo' => array(
            'className' => 'Autenticacao.AutenticacaoGrupo',
            'joinTable' => 'autenticacao_grupo_autenticacao_permissao',
            'dependent' => false,
        )
    );

}