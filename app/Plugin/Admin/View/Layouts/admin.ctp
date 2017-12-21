<?php
    App::uses('CakeTime', 'Utility');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title><?php echo $this->fetch('title'); ?></title>	
        <?php echo $this->Html->charset(); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css('bootstrap.min');
            echo $this->Html->css('font-awesome.min');
            echo $this->Html->css('pnotify.custom.min');
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
    <body class="fixed-sidebar pace-done">
        <div id="wrapper">
            <!-- sidebar menu -->
            <?php echo $this->AdminTemplate->sideMenu(); ?>
            <!-- /sidebar menu -->
            <div id="page-wrapper-parent">
                <div id="page-wrapper" class="gray-bg" style="padding-bottom: 70px">
                    <!-- nav_title -->
                    <?php echo $this->AdminTemplate->topNavigation(); ?>
                    <!-- /nav_title -->
                    <?php echo $this->Session->flash('success'); ?>
                    <?php echo $this->Session->flash('info'); ?>
                    <?php echo $this->Session->flash('warning'); ?>
                    <?php echo $this->Session->flash('error'); ?>				
                    <?php echo $this->fetch('content'); ?>
                    <?php echo $this->element('sql_dump'); ?>
                    <?php echo $this->AdminTemplate->footer(); ?>				
                </div>
            </div>
        </div>			
        <div id="modal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>
        <div id="modal-lg" class="modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                </div>
            </div>
        </div>
    </body>
</html>
