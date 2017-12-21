<?php

    App::uses('Estado', 'Lib');

    $this->FieldMask->data('#SolicitacaoRgEmissaoData');
    $this->FieldMask->cpf('#SolicitacaoCpf');

    $class = 'form-simulador dados';
    $type = 'file';
    $inputDefaults = array(
        'div' => array('class' => 'field'),
        'format' => array('before', 'input', 'between', 'label', 'after', 'error'),
    );
    echo $this->Html->tag('h2', 'Envio de documentos');
    echo $this->Form->create('SolicitacaoDocumento', compact('class', 'inputDefaults', 'type'));
    echo $this->Html->tag('div', null, array('class' => 'row'));
    echo $this->Html->tag('h4', 'Selfie com o documento');
    echo $this->Html->tag('p', 'Para finalizar tire uma selfie junto com o documento escolhido. '
            . 'N�o se esque�a de mostrar seu rosto e manter o documento leg�vel.');
    echo $this->Form->input('id');
    echo $this->Form->input('arquivo', array(
        'before' => '<label>',
        'after' => '</label>',
        'label' => '<figure></figure><span></span>',
        'type' => 'file',
        'id' => 'file-6',
        'class' => 'inputfile inputfile-5',
        'div' => '',
        'data-multiple-caption' => '{count} files selected',
    ));
    echo $this->Form->button('Pr�ximo', array('class' => 'button radius'));
    echo $this->Html->tag('/div');
    echo $this->Form->end();

    