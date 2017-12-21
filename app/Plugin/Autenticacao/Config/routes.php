<?php

    Router::connect('/admin', array('plugin' => 'autenticacao', 'controller' => 'autenticacao_usuarios', 'action' => 'login', 'admin' => false));
    Router::connect('/logout', array('plugin' => 'autenticacao', 'controller' => 'autenticacao_usuarios', 'action' => 'logout', 'admin' => false));
    