<?php

    //Simulador
    Router::connect('/', array('plugin' => 'leal', 'controller' => 'simulador', 'action' => 'index'));
    Router::connect('/solicitacao/prazo/:orgao/:valor', array('plugin' => 'leal', 'controller' => 'simulador', 'action' => 'prazo'), array('orgao' => '[\w-]+', 'valor' => '\d+', 'pass' => array('orgao', 'valor')));
    //Solicitação
    Router::connect('/solicitacao/:uuid/sobre-voce-1', array('plugin' => 'leal', 'controller' => 'solicitacao', 'action' => 'etapa_1'), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/solicitacao/:uuid/sobre-voce-2', array('plugin' => 'leal', 'controller' => 'solicitacao', 'action' => 'etapa_2'), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/solicitacao/:uuid/documentacao', array('plugin' => 'leal', 'controller' => 'solicitacao', 'action' => 'etapa_3'), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/solicitacao/:uuid/dados-bancarios', array('plugin' => 'leal', 'controller' => 'solicitacao', 'action' => 'etapa_4'), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/solicitacao/:uuid/confirmar-dados', array('plugin' => 'leal', 'controller' => 'solicitacao', 'action' => 'confirmar_dados'), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/solicitacao/:uuid/parabens', array('plugin' => 'leal', 'controller' => 'solicitacao', 'action' => 'confirmacao'), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    //Documentos
    Router::connect('/documentos/:uuid', array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'index'), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/documentos/:uuid/identificacao/frente', array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'add', 1), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/documentos/:uuid/identificacao/verso', array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'add', 2), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/documentos/:uuid/identificacao/selfie', array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'add', 3), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/documentos/:uuid/contracheque', array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'add', 4), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/documentos/:uuid/comprovante-residencia', array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'add', 5), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    //Documentos - confirmacao
    Router::connect('/documentos/:uuid/identificacao/frente/confirmar', array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'confirmar', 1), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/documentos/:uuid/identificacao/verso/confirmar', array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'confirmar', 2), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/documentos/:uuid/identificacao/selfie/confirmar', array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'confirmar', 3), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/documentos/:uuid/contracheque/confirmar', array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'confirmar', 4), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    Router::connect('/documentos/:uuid/comprovante-residencia/confirmar', array('plugin' => 'leal', 'controller' => 'solicitacao_documento', 'action' => 'confirmar', 5), array('uuid' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}', 'pass' => array('uuid')));
    