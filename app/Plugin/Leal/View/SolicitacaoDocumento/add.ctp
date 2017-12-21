<?php
    $type = 'file';
    $inputDefaults = array(
        'div' => array('class' => 'field'),
        'format' => array('before', 'input', 'between', 'label', 'after', 'error'),
    );
    echo $this->element('breadcrumb', array('etapa' => 'etapa_5'));
    echo $this->Form->create('SolicitacaoDocumento', compact('inputDefaults', 'type'));
    echo $this->Html->tag('div', null, array('class' => 'form-simulador dados'));
    echo $this->Html->tag('div', null, array('class' => 'rowfields'));
    echo $this->Html->tag('h4', '5. Documentos');
    echo $this->Html->tag('h4', $solicitacaoTipoDocumento['SolicitacaoTipoDocumento']['descricao']);
    echo $this->Html->tag('p', $solicitacaoTipoDocumento['SolicitacaoTipoDocumento']['instrucoes']);
    echo $this->Form->input('arquivo', array(
        'before' => '<label>',
        'after' => '</label>',
        'label' => '<figure></figure><span></span>',
        'type' => 'file',
        'id' => 'file-6',
        'class' => 'inputfile inputfile-5',
        'div' => '',
    ));
    echo $this->Html->tag('br', null, array('class' => 'clear'));
    echo $this->Html->tag('/div');
    echo $this->Html->tag('/div');
    echo $this->Form->button('Salvar foto', array('class' => 'etapas-cadastro button radius'));
    echo $this->Form->end();
?>