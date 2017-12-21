<div class="clear"></div>
<div class="footer">
    <div class="pull-right">
        <a href="http://lealpromotora.com.br" target="_blank">
            <?php echo $this->Html->image('admin/leal.png'); ?>
        </a>
    </div>
    <div>
        <small>
            <?php echo $this->Html->tag('strong', $sistema, array('icon' => $icone)); ?><br />
            <?= $versao; ?> - <?php echo CakeTime::format($data, '%d/%m/%Y'); ?>
        </small>
    </div>
</div>