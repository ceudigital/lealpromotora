<li class="<?php echo $current ? 'active' : ''; ?>">
    <a>
        <?php echo sprintf('<i class="%s"></i>', $params['options']['icon']); ?>
        <span class="nav-label"><?php echo $label; ?></span> 
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level collapse">
        <?php
            foreach ($params['links'] as $item => $url) {
                $options = array(
                    'class' => $this->AdminSideMenu->isCurrent($url) ? 'active' : null,
                    'escape' => false,
                );
                echo $this->Html->tag('li', $this->Html->link($item, $url), $options);
            }
        ?>
    </ul>
</li>