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
                Para podermos atender voc� mais r�pido precisamos de uma c�pia de alguns documentos.<br /><br />

Al�m disso para maior seguran�a de nossos clientes pedimos para voc� tirar uma foto segurando seu documento pr�ximo ao rosto(selfie), assim temos certeza que n�o � uma pessoa desconhecida realizando essa solicita��o.<br /><br />
            </p>
            <?php echo $this->SolicitacaoDocumento->listaDocumentos($uuid, $solicitacaoTipoDocumentos); ?>
            <br />
            
        </div>
    
</div>
<?php echo $linkConfirmar ?>