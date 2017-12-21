
<?php

    //Extende a view padrao
    $this->extend('/Comum/admin_form');

    //Titulo
    $this->assign('pageTitle', 'Grupos de Usu�rios');

    //Formul�rio (content)
    echo $this->Form->create('AutenticacaoGrupo');
    echo $this->Form->input('id');
    echo $this->Form->input('descricao', array('label' => 'Descri��o', 'div' => 'input span-12 first', 'disabled' => 'disabled'));
    echo $this->Form->input('redirecionar', array('label' => 'P�gina de entrada', 'div' => 'input span-12 first', 'disabled' => 'disabled'));
    echo $this->Form->input('AutenticacaoPermissao', array('label' => 'Atribuir permiss�es', 'div' => 'input span-24 last', 'multiple' => 'checkbox'));
    echo $this->Html->tag('div', null, array('class' => 'submit'));
    echo $this->Form->button('Salvar', array('type' => 'submit'));
    echo $this->Form->button('Cancelar', array('type' => 'reset'));
    echo $this->Html->tag('/div');
    echo $this->Form->end();
    