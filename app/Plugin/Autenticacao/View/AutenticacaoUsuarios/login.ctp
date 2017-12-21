<div class="middle-box text-center loginscreen animated fadeIn">
    <div>
        <div>
            <h1 class="logo-name">LEAL+</h1>
        </div>
        <h3>Leal Promotora</h3>
        <p>Informe seu usuário e senha para entrar.</p>
        <?php
            echo $this->Form->create('AutenticacaoUsuario', array('class' => 'm-t'));
            echo $this->Form->input('email', array('tabIndex' => 1, 'label' => false, 'placeholder' => 'E-mail', 'tabindex' => '1', 'autofocus' => true, 'class' => 'form-control', 'div' => 'form-group'));
            echo $this->Form->input('password', array('tabIndex' => 2, 'label' => false, 'placeholder' => 'Senha', 'tabindex' => '2', 'class' => 'form-control', 'div' => 'form-group'));
            echo $this->Form->submit('Entrar', array('title' => 'Entrar', 'alt' => 'Entrar', 'tabindex' => '3', 'class' => 'btn btn-success block full-width m-b', 'div' => 'form-group'));
            echo $this->Form->end();
        ?>
        <a href="#"><small>Esqueceu sua senha?</small></a>
        <!--<p class="text-muted text-center"><small>Do not have an account?</small></p>-->
        <!--<a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>-->
        <p class="m-t">
            <?php
                App::uses('CakeTime', 'Utility');
                Configure::load('sistema');
                $sistema = Configure::read('Sistema.titulo');
                $versao = Configure::read('Sistema.versao');
                $data = CakeTime::i18nFormat(Configure::read('Sistema.data'), '%d de %B de %Y');
                echo $this->Html->tag('small', sprintf('<strong>%s</strong><br /> v.%s de %s', $sistema, $versao, $data));
            ?>
        </p>
    </div>
</div>