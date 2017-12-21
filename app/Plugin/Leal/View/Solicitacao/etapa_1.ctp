<?php

    App::uses('Estado', 'Lib');
    $this->FieldMask->telefone9('#SolicitacaoTelefoneFixo');
    $this->FieldMask->telefone9('#SolicitacaoTelefoneCelular');
    $this->FieldMask->data('#SolicitacaoDataNascimento');
    $this->FieldMask->cep('#SolicitacaoCep');

    $inputDefaults = array(
        'div' => array('class' => 'field'),
    );
    echo $this->element('breadcrumb', array('etapa' => 'etapa_1'));
    echo $this->Form->create('Solicitacao', compact('inputDefaults'));
    echo $this->Html->tag('div', null, array('class' => 'form-simulador dados'));
    echo $this->Html->tag('div', null, array('class' => 'rowfields'));
    echo $this->Html->tag('h4', '1. Sobre você');
    echo $this->Form->input('id');
    echo $this->Form->input('nome', array('label' => 'Nome', 'placeholder' => 'Seu nome completo', 'autofocus'));
    echo $this->Form->input('telefone_fixo', array('label' => 'Telefone fixo', 'placeholder' => 'Ex. (99) 9999-9999', 'type' => 'tel'));
    echo $this->Form->input('telefone_celular', array('label' => 'Telefone celular', 'placeholder' => 'Ex. (99) 9999-9999', 'type' => 'tel'));
    echo $this->Form->input('email', array('placeholder' => 'Ex. contato@lealpromotora.com.br', 'label' => 'E-mail', 'type' => 'email'));
    echo $this->Form->input('data_nascimento', array('label' => 'Nascimento', 'placeholder' => 'Ex. 07/03/1981', 'type' => 'tel', 'autofocus'));
    echo $this->Form->input('sexo', array('label' => 'Sexo', 'empty' => 'Selecione', 'options' => array('F' => 'Feminino', 'M' => 'Masculino')));
    echo $this->Form->input('estado_civil_id', array('label' => 'Estado civil', 'empty' => 'Selecione'));
    echo $this->Form->input('nome_mae', array('label' => 'Nome da mãe', 'placeholder' => 'Ex. Maria da Silva'));
    echo $this->Form->input('nome_pai', array('label' => 'Nome do pai', 'placeholder' => 'Ex. José da Silva'));
    $link_cep = $this->Html->link('Não sabe seu CEP?', 'http://www.buscacep.correios.com.br/sistemas/buscacep/buscaCepEndereco.cfm', array('class' => 'link_cep', 'target' => '_blank'));
    echo $this->Form->input('cep', array('label' => 'CEP', 'placeholder' => 'Ex. 88070-300', 'type' => 'tel', 'after' => $link_cep));
    echo $this->Form->input('endereco', array('label' => 'Endereço', 'placeholder' => 'Ex. Rua Dr. Heitor Blum'));
    echo $this->Form->input('numero', array('label' => 'Número', 'placeholder' => 'Ex. 779', 'div' => 'field w50'));
    echo $this->Form->input('complemento', array('label' => 'Complemento', 'placeholder' => 'Ex. Sala 1', 'div' => 'field w50 ml30'));
    echo $this->Form->input('bairro', array('label' => 'Bairro', 'placeholder' => 'Ex. Estreito'));
    echo $this->Form->input('cidade', array('label' => 'Cidade', 'placeholder' => 'Ex. Florianópolis', 'div' => 'field w50'));
    echo $this->Form->input('estado', array('label' => 'Estado', 'empty' => 'Selecione', 'options' => Estado::getList(), 'div' => 'field w50 ml30'));
    echo $this->Html->tag('br', null, array('class' => 'clear'));
    echo $this->Html->tag('/div');
    echo $this->Html->tag('/div');
    echo $this->Form->button('Próximo', array('class' => 'etapas-cadastro button radius'));

    echo $this->Form->end();

    