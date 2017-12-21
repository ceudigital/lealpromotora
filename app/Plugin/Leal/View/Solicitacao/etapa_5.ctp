<?php

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
    echo $this->Html->tag('h4', 'Frente do documento');
    echo $this->Html->tag('p', 'Agora você precisa enviar algumas fotos do seu '
            . 'documento de identificação, pode ser sua CNH ou RG, porém '
            . 'pedimos que envie todas as fotos do mesmo documento. '
            . ' Primeiro precisamos de uma foto da frente do documento escolhido.');
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
    echo $this->Form->button('Próximo', array('class' => 'button radius'));
    echo $this->Html->tag('/div');
    echo $this->Form->end();

    