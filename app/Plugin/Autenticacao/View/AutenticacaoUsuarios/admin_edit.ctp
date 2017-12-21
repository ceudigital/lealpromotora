
<?php

   //Extende a view padrao
   $this->extend('/Comum/admin_form');

   //Titulo
   $this->assign('pageTitle', 'Usuários');

   //Formulário (content)
   echo $this->Form->create('AutenticacaoUsuario');
   echo $this->Form->input('id');
   echo $this->Form->input('nome', array('label' => 'Nome', 'div' => 'input span-8'));
   echo $this->Form->input('email', array('label' => 'E-mail', 'div' => 'input span-8 clear'));
   echo $this->Form->input('autenticacao_grupo_id', array('label' => 'Grupo', 'empty' => 'Selecione', 'div' => 'input span-8 clear'));
   echo $this->Form->input('password', array('label' => 'Senha', 'div' => 'input span-8 clear   '));
   echo $this->Form->input('password_confirm', array('type' => 'password', 'label' => 'Repita a senha' , 'div' => 'input span-8'));
   echo $this->Form->input('ativo', array('label' => 'Ativo', 'div' => 'input checkbox span-8'));
   echo $this->Form->input('email_confirmado', array('label' => 'E-mail confirmado', 'div' => 'input checkbox span-8'));
   echo $this->Html->tag('div', null, array('class' => 'submit'));
   echo $this->Form->button('Salvar', array('type' => 'submit'));
   echo $this->Form->button('Cancelar', array('type' => 'reset'));
   echo $this->Html->tag('/div');
   echo $this->Form->end();
?>