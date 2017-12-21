<?php

    $this->extend('Admin.Common/index');
    $this->assign('pageTitle', 'Tabelas');
    $this->assign('pageSubtitle', 'Tabelas');

    $this->Html->addCrumb('Tabelas');

    $this->start('actions');
    echo $this->Tabela->incluir();
    $this->end();

    $this->start('headings');
    $tableHeaders = array(
        $this->Paginator->sort('vigencia_inicio', 'Vig�ncia'),
        $this->Paginator->sort('Orgao.descricao', '�rg�o'),
        'Editar',
    );
    echo $this->Html->tableHeaders($tableHeaders);
    $this->end();

    $this->start('data');
    $tableCells = array();
    foreach ($tabelas as $tabela) {
        $tableCells[] = array(
            $this->Tabela->vigencia($tabela),
            $this->Tabela->orgao($tabela),
            array($this->Tabela->editar($tabela), array('style' => 'width:1%')),
        );
    }
    echo $this->Html->tableCells($tableCells);
    $this->end();
    