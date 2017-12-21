<?php

    $this->extend('Admin.Common/form');
    $this->assign('pageTitle', 'Órgãos');
    $this->assign('pageSubtitle', 'Editar órgão');

    $this->Html->addCrumb('Órgãos', array('action' => 'index'));
    $this->Html->addCrumb('Editar');

    $this->start('form');
    echo $this->Form->create('Orgao', array('type' => 'horizontal'));
    echo $this->Form->input('id');
    echo $this->Form->input('descricao', array('label' => 'Descrição'));
    echo $this->Form->input('slug', array('label' => 'Slug'));
    echo $this->Form->submit('Gravar', array('class' => 'btn btn-primary'));
    echo $this->Form->end();
    $this->end();
    