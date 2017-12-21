<?php
    $class = 'form-simulador dados';
    $inputDefaults = array(
        'div' => array('class' => 'field'),
        'format' => array('before', 'input', 'between', 'label', 'after', 'error'),
    );
    echo $this->element('breadcrumb', array('etapa' => 'etapa_5'));
    echo $this->Form->create('SolicitacaoDocumento', compact('inputDefaults'));
    echo $this->Html->tag('div', null, array('class' => 'form-simulador dados'));
    echo $this->Html->tag('div', null, array('class' => 'rowfields'));
    echo $this->Html->tag('h4', '5. Documentos');
    echo $this->Html->tag('h4', $solicitacaoDocumento['SolicitacaoTipoDocumento']['descricao']);
    $link = $this->Html->link('clique aqui', array('action' => 'add', 'uuid' => $uuid, $solicitacaoDocumento['SolicitacaoDocumento']['solicitacao_tipo_documento_id']));
    $txt = <<<TXT
Por favor verifique se a imagem enviada está legível. Se estiver tudo ok aperte no botão abaixo, caso contrário $link para tentar novamente.
TXT;
    echo $this->Html->tag('p', $txt);
    echo $this->Html->image(sprintf('SolicitacaoDocumento/%s', $solicitacaoDocumento['SolicitacaoDocumento']['arquivo']));
    echo $this->Html->tag('br', null, array('class' => 'clear'));
    echo $this->Html->tag('/div');
    echo $this->Html->tag('/div');
    echo $this->Form->button('Confirmar', array('class' => 'etapas-cadastro button radius'));
    echo $this->Form->end();
    