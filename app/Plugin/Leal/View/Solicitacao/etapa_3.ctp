<?php

    $this->FieldMask->numeroInteiro('#SolicitacaoAgencia, #SolicitacaoConta');
    $this->FieldMask->digitoVerificador('#SolicitacaoContaDv');

    $inputDefaults = array(
        'div' => array('class' => 'field'),
    );
    echo $this->element('breadcrumb', array('etapa' => 'etapa_3'));
    echo $this->Form->create('Solicitacao', compact('inputDefaults'));
    echo $this->Html->tag('div', null, array('class' => 'form-simulador dados'));
    echo $this->Html->tag('div', null, array('class' => 'rowfields'));
    echo $this->Html->tag('h4', '3. Dados bancários');
    echo $this->Html->tag('span', 'Somente pode ser depositado na conta do titular', array('class' => 'info'));
    echo $this->Form->input('id');
    echo $this->Form->input('banco_id', array('label' => 'Banco', 'empty' => 'Selecione', 'autofocus'));
    echo $this->Form->input('agencia', array('label' => 'Agência', 'placeholder' => 'Número da agência (sem DV)', 'type' => 'tel'));
    echo $this->Form->input('conta', array('label' => 'Conta', 'placeholder' => 'Número da conta (sem DV)', 'div' => 'field w70', 'type' => 'tel'));
    echo $this->Form->input('conta_dv', array('label' => 'Dígito', 'placeholder' => 'DV', 'div' => 'field w30 ml30'));
    echo $this->Form->input('tipo_conta_id', array('label' => 'Tipo de conta', 'empty' => 'Selecione'));
    echo $this->Html->tag('br', null, array('class' => 'clear'));
    echo $this->Html->tag('/div');
    echo $this->Html->tag('/div');
    echo $this->Form->button('Próximo', array('class' => 'etapas-cadastro button radius'));
    echo $this->Form->end();

    