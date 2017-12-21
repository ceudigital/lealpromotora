<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $this->fetch('title'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
        <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css('default-min');
            echo $this->Html->css('icheck/square');
            echo $this->Html->css('pnotify.custom.min');
            echo $this->Html->css('animate');
            echo $this->Html->css('font-awesome.min');
            echo $this->Html->script('jquery');
            echo $this->Html->script('jquery.mask.min');
            echo $this->Html->script('pnotify.custom.min');
            echo $this->Html->script('jquery.scrollTo.min');
            echo $this->Html->script('icheck.min');
            echo $this->Html->script('default');
            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
        ?>
    </head>
    <body>
        <?php
            if (Ambiente::isProducao()) {
                echo $this->element('google_tag_manager');
                echo $this->element('tawk.to');
            }
        ?>
        <?php echo $this->element('default_header'); ?>
        <div id="features" class="section features animated fadeIn">
            <?php echo $this->Session->flash('success'); ?>
            <?php echo $this->Session->flash('info'); ?>
            <?php echo $this->Session->flash('warning'); ?>
            <?php echo $this->Session->flash('error'); ?>
            <?php echo $this->fetch('content'); ?>
            <?php echo $this->element('sql_dump'); ?>
        </div>
        <?php echo $this->element('default_footer'); ?>
    </body>
</html>