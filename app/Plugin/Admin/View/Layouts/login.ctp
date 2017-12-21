<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css('animate');
            echo $this->Html->css('font-awesome.min');
            echo $this->Html->css('pnotify.custom.min');
            echo $this->Html->css('bootstrap.min');
            echo $this->Html->css('Admin.admin');
            echo $this->Html->script('jquery');
            echo $this->Html->script('pnotify.custom.min');
            echo $this->Html->script('bootstrap.min');
            echo $this->Html->script('default');
            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
        ?>
    </head>
    <body class="white-bg">
        <?php echo $this->Session->flash('success'); ?>
        <?php echo $this->Session->flash('info'); ?>
        <?php echo $this->Session->flash('warning'); ?>
        <?php echo $this->Session->flash('error'); ?>
        <?php echo $this->fetch('content'); ?>
    </body>
</html>
