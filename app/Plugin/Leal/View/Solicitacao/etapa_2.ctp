<?php

    App::uses('Estado', 'Lib');

    $this->FieldMask->data('#SolicitacaoRgEmissaoData');
    $this->FieldMask->cpf('#SolicitacaoCpf');

    $class = 'form-simulador dados';
    $inputDefaults = array(
        'div' => array('class' => 'field'),
    );
    echo $this->element('breadcrumb', array('etapa' => 'etapa_2'));
    echo $this->Form->create('Solicitacao', compact('class', 'inputDefaults'));
    echo $this->Html->tag('div', null, array('class' => 'form-simulador dados'));
    echo $this->Html->tag('div', null, array('class' => 'rowfields'));
    echo $this->Html->tag('h4', '2. Documentação');
    echo $this->Form->input('id');
    echo $this->Form->input('cpf', array('label' => 'CPF', 'placeholder' => 'Ex. 123.456.789-01', 'type' => 'tel', 'autofocus'));
    echo $this->Form->input('rg', array('label' => 'RG', 'placeholder' => 'Ex. 123456789'));
    echo $this->Form->input('rg_emissao_estado', array('label' => 'Estado onde o RG foi emitido', 'empty' => 'Selecione', 'options' => Estado::getList()));
    echo $this->Form->input('rg_emissao_data', array('label' => 'Data de emissão do RG', 'placeholder' => 'Ex. 03/12/1984', 'type' => 'tel'));
    echo $this->Form->input('matricula_beneficio', array('label' => 'Matrícula/benefício', 'placeholder' => 'Ex. 12345'));
    echo $this->Html->tag('br', null, array('class' => 'clear'));
    echo $this->Html->tag('/div');
    echo $this->Html->tag('/div');
    echo $this->Form->button('Próximo', array('class' => 'etapas-cadastro button radius'));
    echo $this->Form->end();

    