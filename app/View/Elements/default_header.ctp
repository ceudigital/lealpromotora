<header id="header">
    <div id="top" data-magellan-expedition="fixed">
        <div class="large-12 columns">
            <nav class="top-bar">
                <ul class="title-area">
                    <li class="name logo">
                        <?php
                            $options = array(
                                'width' => '118',
                                'height' => '39',
                                'alt' => 'Leal Promotora',
                                'url' => 'https://lealpromotora.com.br',
                            );
                            echo $this->Html->image('logo-leal-promotora.png', $options);
                        ?>
                    </li>
                    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                </ul>
                <section class="top-bar-section" id="menu">
                    <ul class="right">
                        <li><a href="https://lealpromotora.com.br/quem-somos/" title="Quem somos">Quem somos</a></li>
                        <li><a href="https://lealpromotora.com.br/duvidas-comuns/" title="Dúvidas comuns">Dúvidas comuns</a></li>
                        <li><a href="https://lealpromotora.com.br/blog/" title="Blog">Blog</a></li>
                        <li><a href="https://lealpromotora.com.br/contato/" title="Contato">Contato</a></li>
                        <li><?php echo $this->Html->link('Simule seu empréstimo', '/', array('class' => 'button radius')); ?></li>
                    </ul>
                </section>
            </nav>
        </div>
    </div>
</header>