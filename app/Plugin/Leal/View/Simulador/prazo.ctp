<?php
     $this->FieldMask->telefone9('#SolicitacaoTelefoneFixo');
    $js = <<<JS
$(function(){   
    $('input[type=radio]').iCheck({
        checkboxClass: 'icheckbox icheckbox_square',
        radioClass: 'iradio iradio_square'
    });
    $('input[type=radio]').on('ifChecked', function(event){
        $('form#form-prazos button[type=submit]').removeAttr('disabled');
        $( 'div#div-dados' ).show( "slow" );
    });
});
JS;
    $this->Html->scriptBlock($js, array('inline' => false));
    $id = 'form-prazos';
    $inputDefaults = array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
    );
    echo $this->Html->tag('h2', 'Escolha o prazo');
    echo $this->Form->create('Solicitacao', compact('id', 'inputDefaults'));
    echo $this->Html->tag('div', null, array('class' => 'form-simulador dados'));
    echo $this->Html->tag('h3', $this->Number->currency($valor, 'BRL'));
    echo $this->Simulador->coeficientes($tabela);
    echo $this->Html->tag('br', null, array('class' => 'clear'));
    echo $this->Html->tag('div', null, array('style' => 'display:none','id'=>'div-dados', 'class'=>'rowfields'));
    echo $this->Html->tag('h4', '1. Sobre você');
    echo $this->Html->tag('div', null, array('class' => 'field'));
    echo $this->Form->input('nome', array('label' => 'Nome', 'placeholder' => 'Seu nome completo', 'autofocus'));
    echo $this->Html->tag('/div');
    echo $this->Html->tag('div', null, array('class' => 'field'));
    echo $this->Form->input('telefone_fixo', array('label' => 'Telefone', 'placeholder' => 'Ex. (99) 9999-9999', 'type' => 'tel'));
    echo $this->Html->tag('/div');
    echo $this->Html->tag('div', null, array('class' => 'field'));
    echo $this->Form->input('email', array('placeholder' => 'Ex. contato@lealpromotora.com.br', 'label' => 'E-mail', 'type' => 'email'));
    echo $this->Html->tag('/div');
    echo $this->Html->tag('/div');
    echo $this->Html->tag('br', null, array('class' => 'clear'));
    echo $this->Html->tag('/div');
    echo $this->Html->tag('div', null, array('class' => 'botoes-prazo'));
    echo $this->Form->button('Solicitar empréstimo', array('class' => 'prazo-cadastro button radius', 'disabled' => 'disabled', 'id' => 'botaoSolicitarContato'));
    echo $this->Html->link('Voltar', '/',array('class' => 'prazo-voltar'));
    echo $this->Html->tag('/div');
    echo $this->Html->tag('br', null, array('class' => 'clear'));
    echo $this->Form->end();
    