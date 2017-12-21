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
echo $this->Form->input('orgao_id', array('empty' => 'Selecione', 'label' => 'Qual o seu convênio?', 'autofocus'));
echo $this->Form->input('valor', array('label' => 'Qual valor você precisa?', 'placeholder' => 'R$ 5.000', 'type' => 'tel'));
echo $this->Html->tag('br', null, array('class' => 'clear'));
echo $this->Html->tag('/div');
echo $this->Form->button('Simular empréstimo', array('class' => 'etapas-cadastro button radius', 'id' => 'botaoSimularEmprestimo'));
?>
<p class="initial">Informações adicionais:<br>Prazo de pagamento: Prazo Mínimo: 48 meses, Prazo máximo: 96 meses<br>Custo Efetivo Total: O Custo Efetivo Total (CET)praticado varia CET mínimo: 27,98 % a.a até CET máximo: 31,99 % a.a.<br>Demonstração do custo total para convênio INSS: considerando valor contratado de R$ 1600,00 e prazo de pagamento em 48 meses, Valor da Proposta: R$ 1.600,00 , Valor para Cliente: R$ 1.600,00 , Número de Parcelas: 48 , Valor da Parcela Mensal: R$ 57,30 , Taxa: 2,25 % a.m. , Taxa anual: Efetiva: 30,60 % a.a. , Nominal: 27,00 % a.a. , TC: R$ 0,00 (0,00 %) , IOF: R$ 52,99 (1,93 %) , CET: 2,39 % a.m. / 32,79 % a.a. , Valor total a ser pago: R$ 2.750,40 , Juros Contratados: R$ 1.150,40 (41,83 %) , Valor a financiar: R$ 1.652,99</p>
<?php
echo $this->Form->end();
?>

<div class="confiado-por"><br />Bancos parceiros:</div>

<div class="row">
    <h2>O que é empréstimo consignado?</h2>
    <p>Também conhecido como consignado ou crédito consignado, é um tipo de crédito em que você utiliza <strong>até 30% do valor do seu salário ou benefício como parcela para empréstimo</strong>. Este valor é descontado todo mês direto de sua folha de pagamento, a Leal está buscando os principais convênios do mercado, no momento estamos trabalhando exclusivamente com Aposentados e Pensionistas do INSS, Funcionários Públicos do Governo de SC e Funcionários Públicos Federais(SIAPE).<br /><br />
        É um ótimo negócio porque os juros são os menores do mercado, a partir de 1,8% ao mês.<br />
        Faça aquela reforma tão esperada, viaje, abra seu negócio, quite suas dívidas. Com o consignado seus planos saem do papel.</p>
</div>

<div class="rosa">
    <div class="row">
        <h2>Quanto eu pago por um empréstimo de R$ 5.000 em 4 anos?</h2>
        <p>Bom, isso vai depender do seu convênio.<br />
            Se você for aposentado ou pensionista, vai pagar <strong>R$ 9 mil</strong>. Em um empréstimo pessoal, com o mesmo valor e em condições semelhantes geraria uma dívida de R$ 32 mil. No cartão de crédito, a diferença é astronômica, chegando a R$ 52 mil.<br />
            Na Leal, conseguimos <strong>taxas a partir de 1,8% ao mês</strong> porque nosso produto diminui o risco do empréstimo. Como o valor será debitando antes mesmo de seu salário ou benefício ser depositado, o banco tem a garantia de pagamento. E, com isso, <strong>o crédito fica mais mais barato para você</strong>.
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
        <p>Não tem segredo. Como a parcela é debitada direto no seu contracheque, o risco diminui e os juros são menores.</p>
    </div>
    <div class="box">
        <?php echo $this->Html->image('nos-preocupamos-com-vc.png'); ?>
        <h2>Nos preocupamos com você</h2>
        <p>Queremos orientar você a fazer o melhor negócio conforme sua necessidade.<br>&nbsp;</p>
    </div>
    <div class="box">
        <?php echo $this->Html->image('tecnologia.png'); ?>
        <h2>Mais tecnologia e transparência</h2>
        <p>Você faz tudo sem sair de casa e nós acompanhamos e informamos a cada etapa.</p>
    </div>

</div>
<div class="faca-seu-emprestimo"><h2>Realize seus sonhos.<br />Faça agora o seu empréstimo.</div>