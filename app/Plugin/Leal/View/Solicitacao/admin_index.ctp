<?php

    $this->extend('Admin.Common/index');
    $this->assign('pageTitle', 'Solicita��es');
    $this->assign('pageSubtitle', 'Solicita��es');

    $this->Html->addCrumb('Solicita��es');

    $this->start('data');
    $tableCells = array();
    foreach ($solicitacoes as $solicitacao) {
        $tableCells[] = array(
            $this->Solicitacao->id($solicitacao),
            $this->Solicitacao->solicitante($solicitacao),
            $this->Solicitacao->convenio($solicitacao),
            $this->Solicitacao->valor($solicitacao),
            $this->Solicitacao->data($solicitacao),
            $this->Solicitacao->progressoPreenchimento($solicitacao),
            $this->Solicitacao->progressoDocumentos($solicitacao),
            $this->Solicitacao->ver($solicitacao),
        );
    }
    echo $this->Html->tableCells($tableCells);
    $this->end();
    