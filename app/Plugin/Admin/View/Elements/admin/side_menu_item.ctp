<?php

    echo $this->Html->tag('li', null, array('class' => $current ? 'active' : ''));
    $label = $this->Html->tag('span', $label, array('class' => 'nav-label'));
    $options = array(
        'escape' => false,
        'icon' => isset($params['options']['icon']) ? $params['options']['icon'] : null,
    );
    echo $this->Html->link($label, $params['url'], $options);
    echo $this->Html->tag('/li');
    