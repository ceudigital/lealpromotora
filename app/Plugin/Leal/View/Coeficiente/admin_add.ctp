<?php

    $this->extend('Admin.Common/form');
    $this->assign('pageTitle', 'Tabelas');
    $this->assign('pageSubtitle', 'Incluir tabela');

    $this->Html->addCrumb('Tabelas', array('action' => 'index'));
    $this->Html->addCrumb('Incluir');

    $this->start('form');
    echo $this->Form->create('Tabela', array('type' => 'horizontal'));
    echo $this->Form->input('tabela_id', array('label' => 'Tabela'));
    echo $this->Form->input('prazo', array('label' => 'Prazo'));
    echo $this->Form->input('coeficiente', array('label' => 'Coeficiente'));
    echo $this->Form->submit('Gravar', array('class' => 'btn btn-primary'));
    echo $this->Form->end();
    $this->end();
    