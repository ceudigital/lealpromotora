<?php
    echo $this->AdminTemplate->pageHeading($this->fetch('pageTitle'));
?>
<div class="wrapper wrapper-content">
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
                    <?php
                        if ($this->fetch('searchModel')) {
                            echo $this->element('Admin.search_form');
                        }
                    ?>
                    <div class="text-muted text-right small m-b">
                        <?php
                            echo $this->Paginator->counter('Página {:page} de {:pages}, exibindo {:current} registros do total de {:count}.');
                        ?>
                    </div>
                    <table class="table table-hover responsive-stacked-table">
                        <thead>
                            <tr class="headings">
                                <?php echo $this->fetch('headings'); ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $this->fetch('data'); ?>
                        </tbody>
                    </table>
                </div>
                <div class="ibox-footer text-center">
                    <?php echo $this->element('Admin.pagination'); ?>
                </div>
            </div>
        </div>
        <?php if ($this->fetch('sidebar')): ?>
                <div class="col-md-3"><?php echo $this->fetch('sidebar'); ?></div>
            <?php endif; ?>
    </div>
</div>