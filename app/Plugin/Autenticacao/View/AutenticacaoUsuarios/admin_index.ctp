<?php
   //Extende a view padrao
   $this->extend('/Comum/admin_index');

   //Título
   $title = 'Usuários';

   //Filtros
   $this->start('filters');
   echo $this->Form->create('AutenticacaoUsuario', array('action' => 'index'));
   echo $this->Form->input('nome_like', array('label' => 'Nome', 'empty' => 'Nome'));
   echo $this->Form->input('email_like', array('label' => 'E-mail', 'empty' => 'Nome'));
   echo $this->Form->input('autenticacao_grupo_id', array('label' => 'Grupo', 'empty' => 'Todos os grupos'));
   echo $this->Html->tag('div', null, array('class' => 'submit'));
   echo $this->Form->button('Pesquisar', array('type' => 'submit'));
   echo $this->Form->button('Limpar', array('type' => 'reset'));
   echo $this->Html->tag('/div');
   echo $this->Form->end();
   $this->end();
   
   //Cabeçalhos
   $tableHeaders = array(
      $this->Paginator->sort('nome', 'Nome'),
      $this->Paginator->sort('email', 'E-mail'),
      $this->Paginator->sort('autenticacao_grupo_id', 'Grupo'),
      $this->Paginator->sort('ativo', 'Ativo'),
	  $this->Paginator->sort('email_confirmado', 'E-mail confirmado'),
      'Editar',
      'Excluir',
   );

   //Dados
   $tableCells = array();
   foreach ($autenticacaoUsuarios as $autenticacaoUsuario) {
      $tableCells[] = array(
         $autenticacaoUsuario['AutenticacaoUsuario']['nome'],
         $autenticacaoUsuario['AutenticacaoUsuario']['email'],
         $autenticacaoUsuario['AutenticacaoGrupo']['descricao'],
         array($this->Toggle->display($autenticacaoUsuario, 'ativo'), array('class' => 'a-center')),
		 array($this->Toggle->display($autenticacaoUsuario, 'email_confirmado'), array('class' => 'a-center')),
         array($this->Action->edit($autenticacaoUsuario), array('class' => 'a-center')),
         array($this->Action->delete($autenticacaoUsuario), array('class' => 'a-center')),
      );
   }

   $this->assign('pageTitle', $title);
   $this->set('tableHeaders', $tableHeaders);
   $this->set('tableCells', $tableCells);
   $this->set('colspan', 7);
?>