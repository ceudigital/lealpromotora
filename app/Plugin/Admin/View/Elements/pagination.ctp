<ul class="pagination">
    <?php
        $options = array(
            'tag' => 'li',
            'escape' => false,
        );
        $options_numbers = array(
            'tag' => 'li',
            'separator' => null,
            'currentTag' => 'span',
            'currentClass' => 'active',
        );
        echo $this->Paginator->first('<i class="fa fa-angle-double-left"></i>', $options);
        echo $this->Paginator->prev('<i class="fa fa-angle-left"></i>', $options, '&nbsp;');
        echo $this->Paginator->numbers($options_numbers);
        echo $this->Paginator->next('<i class="fa fa-angle-right"></i>', $options, '&nbsp;');
        echo $this->Paginator->last('<i class="fa fa-angle-double-right"></i>', $options);
    ?>
</ul>