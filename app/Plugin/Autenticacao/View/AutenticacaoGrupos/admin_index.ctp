<?php

	//Extende a view padrao
	$this->extend('/Comum/admin_index');

	//T�tulo
	$title = 'Grupos de Usu�rios';

	//Filtros
	$this->start('filters');
	echo $this->Form->create('AutenticacaoGrupo', array('action' => 'index'));
	echo $this->Form->input('descricao_like', array('label' => 'Descri��o'));
	echo $this->Html->tag('div', null, array('class' => 'submit'));
	echo $this->Form->button('Pesquisar', array('type' => 'submit'));
	echo $this->Form->button('Limpar', array('type' => 'reset'));
	echo $this->Html->tag('/div');
	echo $this->Form->end();
	$this->end();

	//Cabe�alhos
	$tableHeaders = array(
		$this->Paginator->sort('descricao', 'Descri��o'),
		'Editar',
	);

	//Dados
	$tableCells = array();
	debug($autenticacaoGrupos);
	foreach ($autenticacaoGrupos as $autenticacaoGrupo) {
		$tableCells[] = array(
			$autenticacaoGrupo['AutenticacaoGrupo']['descricao'],
			array($this->Action->edit($autenticacaoGrupo), array('class' => 'a-center')),
		);
	}

	$this->assign('pageTitle', $title);
	$this->set('tableHeaders', $tableHeaders);
	$this->set('tableCells', $tableCells);
	$this->set('colspan', 2);
?>