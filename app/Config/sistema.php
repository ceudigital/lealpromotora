<?php

    $config['Sistema']['titulo'] = 'Simulador Leal Promotora';
    $config['Sistema']['icone'] = 'fa fa-money';
    $config['Sistema']['versao'] = '2.1.3';
    $config['Sistema']['data'] = '2017-05-21';
    $config['Sistema']['menu'] = array(
        'Solicitações' => array(
            'options' => array(
                'icon' => 'fa fa-usd',
            ),
            'links' => array(
                'Em aberto' => array('plugin' => 'leal', 'controller' => 'solicitacao', 'action' => 'index', 'admin' => true),
                'Receber' => array('plugin' => 'leal', 'controller' => 'solicitacao', 'action' => 'index2', 'admin' => true),
                'Processamento' => array('plugin' => 'leal', 'controller' => 'solicitacao', 'action' => 'index3', 'admin' => true),
                'Concluídas' => array('plugin' => 'leal', 'controller' => 'solicitacao', 'action' => 'index4', 'admin' => true),
            ),
        ),
        'Órgãos' => array(
            'options' => array(
                'icon' => 'fa fa-building',
            ),
            'url' => array('plugin' => 'leal', 'controller' => 'orgao', 'action' => 'index', 'admin' => true),
        ),
        'Tabelas' => array(
            'options' => array(
                'icon' => 'fa fa-table',
            ),
            'url' => array('plugin' => 'leal', 'controller' => 'tabela', 'action' => 'index', 'admin' => true),
        ),
        'Coeficientes' => array(
            'options' => array(
                'icon' => 'fa fa-percent',
            ),
            'url' => array('plugin' => 'leal', 'controller' => 'coeficiente', 'action' => 'index', 'admin' => true),
        ),
        'Bancos' => array(
            'options' => array(
                'icon' => 'fa fa-bank',
            ),
            'url' => array('plugin' => 'leal', 'controller' => 'banco', 'action' => 'index', 'admin' => true)
        ),
    );
    