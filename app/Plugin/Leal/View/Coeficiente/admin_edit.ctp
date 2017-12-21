<?php

    $this->extend('Admin.Common/form');
    $this->assign('pageTitle', 'Coeficientes');
    $this->assign('pageSubtitle', 'Editar coeficiente');

    $this->Html->addCrumb('Coeficientes', array('action' => 'index'));
    $this->Html->addCrumb('Editar');

    $this->start('form');
    echo $this->Form->create('Coeficiente', array('type' => 'horizontal'));
    echo $this->Form->input('id');
    echo $this->Form->input('tabela_id', array('label' => 'Tabela'));
    echo $this->Form->input('prazo', array('label' => 'Prazo'));
    echo $this->Form->input('coeficiente', array('label' => 'Coeficiente'));
    echo $this->Form->submit('Gravar', array('class' => 'btn btn-primary'));
    echo $this->Form->end();
    $this->end();
    