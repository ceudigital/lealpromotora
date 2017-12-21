<?php

    $this->extend('Admin.Common/index');
    $this->assign('pageTitle', 'Órgãos');
    $this->assign('pageSubtitle', 'Órgãos');

    $this->Html->addCrumb('Órgãos');

    $this->start('actions');
    echo $this->Orgao->incluir();
    $this->end();

    $this->start('headings');
    $tableHeaders = array(
        $this->Paginator->sort('descricao', 'Descrição'),
        $this->Paginator->sort('slug', 'Slug'),
        'Editar',
    );
    echo $this->Html->tableHeaders($tableHeaders);
    $this->end();

    $this->start('data');
    $tableCells = array();
    foreach ($orgaos as $orgao) {
        $tableCells[] = array(
            $this->Orgao->descricao($orgao),
            $this->Orgao->slug($orgao),
            array($this->Orgao->editar($orgao), array('style' => 'width:1%')),
        );
    }
    echo $this->Html->tableCells($tableCells);
    $this->end();
    