<?php

	//Extende a view padrao
	$this->extend('/Comum/admin_index');

	//Título
	$title = 'Permissões';

	//Filtros
	$this->start('filters');
	echo $this->Form->create('AutenticacaoPermissao', array('url' => array('controller' => 'autenticacao_permissoes', 'action' => 'index')));
	echo $this->Form->input('titulo_like', array('label' => 'Título'));
//	echo $this->Form->input('descricao_like', array('label' => 'Descrição'));
	echo $this->Html->tag('div', null, array('class' => 'submit'));
	echo $this->Form->button('Pesquisar', array('type' => 'submit'));
	echo $this->Form->button('Limpar', array('type' => 'reset'));
	echo $this->Html->tag('/div');
	echo $this->Form->end();
	$this->end();

	//Cabeçalhos
	$tableHeaders = array(
		$this->Paginator->sort('titulo', 'Título'),
//		$this->Paginator->sort('descricao', 'Descrição'),
		'Grupos',
		'Editar',
	);

	//Dados
	$tableCells = array();
	debug($autenticacaoPermissoes);
	foreach ($autenticacaoPermissoes as $autenticacaoPermissao) {
		$tableCells[] = array(
			$autenticacaoPermissao['AutenticacaoPermissao']['titulo'],
//			$autenticacaoPermissao['AutenticacaoPermissao']['descricao'],
			implode(', ', Set::extract('/AutenticacaoGrupo/descricao', $autenticacaoPermissao)),
			array($this->Action->edit($autenticacaoPermissao), array('class' => 'a-center')),
		);
	}

	$this->assign('pageTitle', $title);
	$this->set('tableHeaders', $tableHeaders);
	$this->set('tableCells', $tableCells);
	$this->set('colspan', 3);
?>