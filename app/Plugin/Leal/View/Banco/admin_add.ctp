<?php

    $this->extend('Admin.Common/form');
    $this->assign('pageTitle', 'Bancos');
    $this->assign('pageSubtitle', 'Incluir banco');

    $this->Html->addCrumb('Bancos', array('action' => 'index'));
    $this->Html->addCrumb('Incluir');

    $this->start('form');
    echo $this->Form->create('Banco', array('type' => 'horizontal'));
    echo $this->Form->input('codigo', array('label' => 'Código'));
    echo $this->Form->input('descricao', array('label' => 'Descrição'));
    echo $this->Form->submit('Gravar', array('class' => 'btn btn-primary'));
    echo $this->Form->end();
    $this->end();
    