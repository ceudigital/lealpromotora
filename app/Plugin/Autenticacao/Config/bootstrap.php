<?php

    $regras = array(
        'permissao' => 'permissoes',
    );

    Inflector::rules('singular', array('rules' => array(), 'irregular' => $regras, 'uninflected' => array()));
    Inflector::rules('plural', array('rules' => array(), 'irregular' => array_flip($regras), 'uninflected' => array()));
    