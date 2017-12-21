<?php
    $urlConfirmar = array(
        'plugin' => 'leal',
        'controller' => 'solicitacao',
        'action' => 'confirmacao',
        'uuid' => $uuid,
    );
    
    $linkConfirmar = $this->Html->link('Concluir envio', $urlConfirmar, array('class' => 'etapas-cadastro button radius'));

    $url = array(
        'plugin' => 'leal',
        'controller' => 'solicitacao_documento',
        'action' => 'index',
        'uuid' => $uuid,
    );
    $link = $this->Html->link('clique aqui', $url);
    echo $this->element('breadcrumb', array('etapa' => 'etapa_5'));
?>
<div class="form-simulador dados">
    
    <h2>Documentos</h2>
        <div class="rowfields">
            <p>
                Para podermos atender você mais rápido precisamos de uma cópia de alguns documentos.<br /><br />

Além disso para maior segurança de nossos clientes pedimos para você tirar uma foto segurando seu documento próximo ao rosto(selfie), assim temos certeza que não é uma pessoa desconhecida realizando essa solicitação.<br /><br />
            </p>
            <?php echo $this->SolicitacaoDocumento->listaDocumentos($uuid, $solicitacaoTipoDocumentos); ?>
            <br />
            
        </div>
    
</div>
<?php echo $linkConfirmar ?>