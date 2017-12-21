<?php

    $js = <<<JS
    $(function(){
        new PNotify({
            text: '$message',			
            type: '$type',
            styling: 'brighttheme'
        });								
    });
JS;
    echo $this->Html->scriptBlock($js, array('inline' => true));
    