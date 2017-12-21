<?php
    App::uses('CakeTime', 'Utility');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title><?php echo $title_for_layout; ?></title>	
        <?php echo $this->Html->charset(); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css('bootstrap.min');
            echo $this->Html->css('font-awesome.min');
            echo $this->Html->css('pnotify.custom.min');
            echo $this->Html->css('icheck');
            echo $this->Html->css('animate');
            echo $this->Html->css('responsive_stacked_table');
            echo $this->Html->css('Admin.admin');
            echo $this->Html->script('jquery.min');
            echo $this->Html->script('bootstrap.min');
            echo $this->Html->script('jquery.metisMenu');
            echo $this->Html->script('jquery.slimscroll.min');
            echo $this->Html->script('scrolltopcontrol');
            echo $this->Html->script('pnotify.custom.min');
            echo $this->Html->script('bloodhound.min');
            echo $this->Html->script('typeahead.bundle.min');
            echo $this->Html->script('jquery.maskedinput.min');
            echo $this->Html->script('pace.min');
            echo $this->Html->script('icheck.min');
            echo $this->Html->script('Admin.admin');
            echo $this->fetch('script');
            echo $this->fetch('meta');
            echo $this->fetch('css');
        ?>		
    </head>
    <body class="gray-bg">
        <div class="middle-box text-center animated fadeInDown">
            <?php echo $this->fetch('content'); ?>
        </div>
    </body>
</html>
