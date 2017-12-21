<script type="text/javascript">
    $(function () {
        $('#SolicitacaoValor').mask("#.##0", {reverse: true});
    });
</script>
<h2>Simule o valor e prazo ideal</h2>
<?php
$inputDefaults = array(
    'div' => array('class' => 'field'),
);
echo $this->Form->create('Solicitacao', compact('class', 'inputDefaults'));
echo $this->Html->tag('div', null, array('class' => 'form-simulador'));
echo $this->Form->input('orgao_id', array('empty' => 'Selecione', 'label' => 'Qual o seu conv�nio?', 'autofocus'));
echo $this->Form->input('valor', array('label' => 'Qual valor voc� precisa?', 'placeholder' => 'R$ 5.000', 'type' => 'tel'));
echo $this->Html->tag('br', null, array('class' => 'clear'));
echo $this->Html->tag('/div');
echo $this->Form->button('Simular empr�stimo', array('class' => 'etapas-cadastro button radius', 'id' => 'botaoSimularEmprestimo'));
?>
<p class="initial">Informa��es adicionais:<br>Prazo de pagamento: Prazo M�nimo: 48 meses, Prazo m�ximo: 96 meses<br>Custo Efetivo Total: O Custo Efetivo Total (CET)praticado varia CET m�nimo: 27,98 % a.a at� CET m�ximo: 31,99 % a.a.<br>Demonstra��o do custo total para conv�nio INSS: considerando valor contratado de R$ 1600,00 e prazo de pagamento em 48 meses, Valor da Proposta: R$ 1.600,00 , Valor para Cliente: R$ 1.600,00 , N�mero de Parcelas: 48 , Valor da Parcela Mensal: R$ 57,30 , Taxa: 2,25 % a.m. , Taxa anual: Efetiva: 30,60 % a.a. , Nominal: 27,00 % a.a. , TC: R$ 0,00 (0,00 %) , IOF: R$ 52,99 (1,93 %) , CET: 2,39 % a.m. / 32,79 % a.a. , Valor total a ser pago: R$ 2.750,40 , Juros Contratados: R$ 1.150,40 (41,83 %) , Valor a financiar: R$ 1.652,99</p>
<?php
echo $this->Form->end();
?>

<div class="confiado-por"><br />Bancos parceiros:</div>

<div class="row">
    <h2>O que � empr�stimo consignado?</h2>
    <p>Tamb�m conhecido como consignado ou cr�dito consignado, � um tipo de cr�dito em que voc� utiliza <strong>at� 30% do valor do seu sal�rio ou benef�cio como parcela para empr�stimo</strong>. Este valor � descontado todo m�s direto de sua folha de pagamento, a Leal est� buscando os principais conv�nios do mercado, no momento estamos trabalhando exclusivamente com Aposentados e Pensionistas do INSS, Funcion�rios P�blicos do Governo de SC e Funcion�rios P�blicos Federais(SIAPE).<br /><br />
        � um �timo neg�cio porque os juros s�o os menores do mercado, a partir de 1,8% ao m�s.<br />
        Fa�a aquela reforma t�o esperada, viaje, abra seu neg�cio, quite suas d�vidas. Com o consignado seus planos saem do papel.</p>
</div>

<div class="rosa">
    <div class="row">
        <h2>Quanto eu pago por um empr�stimo de R$ 5.000 em 4 anos?</h2>
        <p>Bom, isso vai depender do seu conv�nio.<br />
            Se voc� for aposentado ou pensionista, vai pagar <strong>R$ 9 mil</strong>. Em um empr�stimo pessoal, com o mesmo valor e em condi��es semelhantes geraria uma d�vida de R$ 32 mil. No cart�o de cr�dito, a diferen�a � astron�mica, chegando a R$ 52 mil.<br />
            Na Leal, conseguimos <strong>taxas a partir de 1,8% ao m�s</strong> porque nosso produto diminui o risco do empr�stimo. Como o valor ser� debitando antes mesmo de seu sal�rio ou benef�cio ser depositado, o banco tem a garantia de pagamento. E, com isso, <strong>o cr�dito fica mais mais barato para voc�</strong>.
        </p>
        <p align="center">
            <?php
            $options = array(
                'width' => '257',
                'height' => '259',
                'alt' => 'Leal Promotora',
                'url' => false,
            );
            echo $this->Html->image('modelos.png', $options);
            ?>
        </p>
    </div>
</div>
<div class="home-boxes">
    <h2>Por que devo escolher a Leal?</h2>
    <div class="box">
        <?php echo $this->Html->image('taxas-mais-baixas.png'); ?>
        <h2>Taxas mais baixas</h2>
        <p>N�o tem segredo. Como a parcela � debitada direto no seu contracheque, o risco diminui e os juros s�o menores.</p>
    </div>
    <div class="box">
        <?php echo $this->Html->image('nos-preocupamos-com-vc.png'); ?>
        <h2>Nos preocupamos com voc�</h2>
        <p>Queremos orientar voc� a fazer o melhor neg�cio conforme sua necessidade.<br>&nbsp;</p>
    </div>
    <div class="box">
        <?php echo $this->Html->image('tecnologia.png'); ?>
        <h2>Mais tecnologia e transpar�ncia</h2>
        <p>Voc� faz tudo sem sair de casa e n�s acompanhamos e informamos a cada etapa.</p>
    </div>

</div>
<div class="faca-seu-emprestimo"><h2>Realize seus sonhos.<br />Fa�a agora o seu empr�stimo.</div>