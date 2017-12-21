<?php

    $this->extend('Admin.Common/index');
    $this->assign('pageTitle', 'Coeficientes');
    $this->assign('pageSubtitle', 'Coeficientes');

    $this->Html->addCrumb('Coeficientes');

    $this->start('actions');
    echo $this->Coeficiente->incluir();
    $this->end();

    $this->start('headings');
    $tableHeaders = array(
        $this->Paginator->sort('Tabela.orgao_id', 'Órgão'),
        $this->Paginator->sort('Tabela.id', 'Tabela'),
        $this->Paginator->sort('prazo', 'Prazo'),
        $this->Paginator->sort('coeficiente', 'Coeficiente'),
        'Editar',
    );
    echo $this->Html->tableHeaders($tableHeaders);
    $this->end();

    $this->start('data');
    $tableCells = array();
    foreach ($coeficientes as $coeficiente) {
        $tableCells[] = array(
            $this->Coeficiente->orgao($coeficiente),
            $this->Coeficiente->tabela($coeficiente),
            $this->Coeficiente->prazo($coeficiente),
            $this->Coeficiente->coeficiente($coeficiente),
            array($this->Coeficiente->editar($coeficiente), array('style' => 'width:1%')),
        );
    }
    echo $this->Html->tableCells($tableCells);
    $this->end();
    