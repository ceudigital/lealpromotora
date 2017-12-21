<?php

    $this->extend('Admin.Common/form');
    $this->assign('pageTitle', 'Tabelas');
    $this->assign('pageSubtitle', 'Incluir tabela');

    $this->Html->addCrumb('Tabelas', array('action' => 'index'));
    $this->Html->addCrumb('Incluir');

    $this->start('form');
    $this->MaskedInput->data('#TabelaVigenciaInicio, #TabelaVigenciaFim');
    echo $this->Form->create('Tabela', array('type' => 'horizontal'));
    echo $this->Form->input('orgao_id', array('label' => 'Órgão', 'empty' => 'Selecione'));
    echo $this->Form->input('vigencia_inicio', array('label' => 'Vigência - início', 'type' => 'text'));
    echo $this->Form->input('vigencia_fim', array('label' => 'Vigência - fim', 'type' => 'text'));
    echo $this->Form->submit('Gravar', array('class' => 'btn btn-primary'));
    echo $this->Form->end();
    $this->end();
    