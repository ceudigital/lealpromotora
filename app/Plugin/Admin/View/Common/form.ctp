<?php
    echo $this->AdminTemplate->pageHeading($this->fetch('pageTitle'));
?>
<div class="wrapper wrapper-content">
    <?php if ($this->fetch('form')) { ?>
            <div class="row">
                <div class="<?php echo $this->fetch('sidebar') ? 'col-md-9' : 'col-md-12'; ?>">
                    <div class="ibox">
                        <div class="ibox-title">
                            <?php if ($this->fetch('pageSubtitle')) echo $this->Html->tag('h5', $this->fetch('pageSubtitle')); ?>
                            <div class="ibox-tools">
                                <?php echo $this->fetch('actions'); ?>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <?php echo $this->fetch('form'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php echo $this->fetch('content'); ?>
</div>