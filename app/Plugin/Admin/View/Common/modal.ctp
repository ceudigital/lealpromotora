<?php echo $this->fetch('modal_script'); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?php echo $this->fetch('pageTitle'); ?></h4>
</div>
<div class="modal-body">
    <?php
        echo $this->Session->flash('success');
        echo $this->Session->flash('info');
        echo $this->Session->flash('warning');
        echo $this->Session->flash('error');
        echo $this->fetch('body');
    ?>
</div>
<div class="modal-footer">
    <?php
        if ($this->fetch('footer')) {
            echo $this->fetch('footer');
        } else {
            echo $this->Html->tag('button', 'Fechar', array('type' => 'button', 'class' => 'btn btn-primary', 'data-dismiss' => 'modal'));
        }
    ?>
</div>