<div id="<?php echo $key; ?>Message" class="<?php echo!empty($params['class']) ? $params['class'] : 'message'; ?>"></div>

<script type="text/javascript">
    $(function () {
        new PNotify({
            title: 'Atenção',
            text: '<?php echo $message; ?>',
            type: 'error'
        });
    });
</script>
