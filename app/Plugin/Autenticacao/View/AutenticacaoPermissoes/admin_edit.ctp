
<?php

	//Extende a view padrao
	$this->extend('/Comum/admin_form');

	//Titulo
	$this->assign('pageTitle', 'Permissões');

	//Formulário (content)
	echo $this->Form->create('AutenticacaoPermissao');
	echo $this->Form->input('id');
	echo $this->Form->input('titulo', array('label' => 'Título', 'div' => 'input span-12', 'disabled' => ''));
	echo $this->Form->input('descricao', array('label' => 'Descrição', 'div' => 'input span-24', 'disabled' => 'disabled'));
	echo $this->Form->input('AutenticacaoGrupo', array('label' => 'Autorizar grupos', 'div' => 'input span-24 last', 'multiple' => 'checkbox'));
	echo $this->Html->tag('div', null, array('class' => 'submit'));
	echo $this->Form->button('Salvar', array('type' => 'submit'));
	echo $this->Form->button('Cancelar', array('type' => 'reset'));
	echo $this->Html->tag('/div');
	echo $this->Form->end();
?>