<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
        <div class="sidebar-collapse" style="overflow: hidden; width: auto; height: 100%;">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <?php echo $this->Gravatar->image($this->ControleAcesso->usuario('email'), array('alt' => $this->ControleAcesso->usuario('nome'), 'class' => 'img-circle'), 48); ?>
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                            <span class="clear"> 
                                <span class="block m-t-xs"> 
                                    <strong class="font-bold"><?= $this->ControleAcesso->usuario('nome') ?></strong>
                                </span> 
                                <span class="text-muted text-xs block">Opções <b class="caret"></b></span> 
                            </span> </a>
                        <ul class="dropdown-menu animated fadeIn m-t-xs">							
                            <li>
                                <?php
                                    $url = array('plugin' => 'autenticacao', 'controller' => 'autenticacao_usuarios', 'action' => 'logout', 'admin' => false);
                                    $options = array('icon' => 'fa fa-sign-out');
                                    echo $this->Html->link('Sair', $url, $options);
                                ?>	
                            </li>
                        </ul>
                    </div>					
                </li>
                <?php echo $this->AdminSideMenu->display($menu); ?>					
            </ul>
        </div>
        <div class="slimScrollBar"></div>
    </div>
</nav>