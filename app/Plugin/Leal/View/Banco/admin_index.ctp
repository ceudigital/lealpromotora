<?php

    $this->extend('Admin.Common/index');
    $this->assign('pageTitle', 'Bancos');
    $this->assign('pageSubtitle', 'Bancos');

    $this->Html->addCrumb('Bancos');

    $this->start('actions');
    echo $this->Banco->incluir();
    $this->end();

    $this->start('headings');
    $tableHeaders = array(
        $this->Paginator->sort('codigo', 'Código'),
        $this->Paginator->sort('descricao', 'Descrição'),
        'Editar',
    );
    echo $this->Html->tableHeaders($tableHeaders);
    $this->end();

    $this->start('data');
    $tableCells = array();
    foreach ($bancos as $banco) {
        $tableCells[] = array(
            $this->Banco->codigo($banco),
            $this->Banco->descricao($banco),
            array($this->Banco->editar($banco), array('style' => 'width:1%')),
        );
    }
    echo $this->Html->tableCells($tableCells);
    $this->end();
    