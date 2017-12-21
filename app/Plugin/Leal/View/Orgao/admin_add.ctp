<?php

    $this->extend('Admin.Common/form');
    $this->assign('pageTitle', '�rg�os');
    $this->assign('pageSubtitle', 'Incluir �rg�o');

    $this->Html->addCrumb('�rg�os', array('action' => 'index'));
    $this->Html->addCrumb('Incluir');

    $this->start('form');
    echo $this->Form->create('Orgao', array('type' => 'horizontal'));
    echo $this->Form->input('descricao', array('label' => 'Descri��o'));
    echo $this->Form->input('slug', array('label' => 'Slug'));
    echo $this->Form->submit('Gravar', array('class' => 'btn btn-primary'));
    echo $this->Form->end();
    $this->end();
    