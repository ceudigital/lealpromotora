<h2>Alterar seus dados</h2>

<?php
	echo $this->Form->create('AutenticacaoUsuario');
	echo $this->Form->input('id');
	echo $this->Form->input('name', array('label' => 'Nome'));
	echo $this->Form->input('email', array('label' => 'E-mail'));
?>
<fieldset>
	<legend>Alterar senha</legend>
	<?php
		echo $this->Html->tag('div', 'Preencha os campos abaixo apenas se deseja alterar sua senha', array('class' => 'tip'));
		echo $this->Form->input('passwd', array('label' => 'Senha'));
		echo $this->Form->input('passwd_confirm', array('type' => 'password', 'label' => 'Repita a senha'));
	?>
</fieldset>
<?php
		echo $this->Form->end('Salvar');
?>