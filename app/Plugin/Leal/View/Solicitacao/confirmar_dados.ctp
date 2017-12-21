<?php

    App::uses('Estado', 'Lib');
    App::uses('Sexo', 'Lib');

    $js = <<<JS
$(function(){   
    $('input[type=radio]').iCheck({
        checkboxClass: 'icheckbox icheckbox_square',
        radioClass: 'iradio iradio_square'
    });
    $('input[type=radio]').on('ifChecked', function(event){
        $('form.form-simulador button[type=submit]').removeAttr('disabled');
    });
});
JS;
    $this->Html->scriptBlock($js, array('inline' => false));

    $inputDefaults = array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'field'),
    );
    echo $this->element('breadcrumb', array('etapa' => 'etapa_4'));
    echo $this->Form->create('Solicitacao', compact('inputDefaults'));
    echo $this->Form->input('id');
    echo $this->Html->tag('div', null, array('class' => 'form-simulador dados'));
    echo $this->Html->tag('div', null, array('class' => 'rowfields'));
    echo $this->Html->tag('h4', '1. Dados pessoais');
    echo $this->Confirmacao->texto('Solicitacao.nome', 'Nome');
    echo $this->Confirmacao->texto('Solicitacao.telefone_fixo', 'Telefone fixo');
    echo $this->Confirmacao->texto('Solicitacao.telefone_celular', 'Telefone celular');
    echo $this->Confirmacao->texto('Solicitacao.email', 'E-mail');
    echo $this->Confirmacao->data('Solicitacao.data_nascimento', 'Data de nascimento');
    echo $this->Confirmacao->map('Solicitacao.sexo', 'Sexo', Sexo::getList());
    echo $this->Confirmacao->texto('EstadoCivil.descricao', 'Estado Civil');
    echo $this->Confirmacao->texto('Solicitacao.nome_mae', 'Nome da mãe');
    echo $this->Confirmacao->texto('Solicitacao.nome_pai', 'Nome da pai');
    echo $this->Confirmacao->texto('Solicitacao.cep', 'CEP');
    echo $this->Confirmacao->texto('Solicitacao.endereco', 'Endereço');
    echo $this->Confirmacao->texto('Solicitacao.numero', 'Número');
    echo $this->Confirmacao->texto('Solicitacao.complemento', 'Complemento');
    echo $this->Confirmacao->texto('Solicitacao.bairro', 'Bairro');
    echo $this->Confirmacao->texto('Solicitacao.cidade', 'Cidade');
    echo $this->Confirmacao->map('Solicitacao.estado', 'Estado', Estado::getList());
    echo $this->Html->tag('br', null, array('clear' => 'all'));
    echo $this->Html->tag('hr', null, array('style' => 'margin-top:20px'));
    echo $this->Html->tag('h4', '2. Documentação');
    echo $this->Confirmacao->texto('Solicitacao.cpf', 'CPF');
    echo $this->Confirmacao->texto('Solicitacao.rg', 'RG');
    echo $this->Confirmacao->map('Solicitacao.rg_emissao_estado', 'Estado onde o RG foi emitido', Estado::getList());
    echo $this->Confirmacao->data('Solicitacao.rg_emissao_data', 'Data de emissão do RG');
    echo $this->Confirmacao->texto('Solicitacao.matricula_beneficio', 'Matrícula/Benefício');
    echo $this->Html->tag('br', null, array('clear' => 'all'));
    echo $this->Html->tag('hr', null, array('style' => 'margin-top:20px'));
    echo $this->Html->tag('h4', '3. Dados bancários');
    echo $this->Confirmacao->texto('Banco.codigo_descricao', 'Banco');
    echo $this->Confirmacao->texto('Solicitacao.agencia', 'Agência');
    echo $this->Confirmacao->texto('Solicitacao.conta_com_dv', 'Conta');
    echo $this->Confirmacao->texto('TipoConta.descricao', 'Tipo de conta');
    echo $this->Html->tag('br', null, array('clear' => 'all'));
    echo $this->Html->tag('hr', null, array('style' => 'margin-top:20px'));    
    echo $this->Html->tag('h4', '4. Dados do empréstimo');
    echo $this->Confirmacao->monetario('Solicitacao.valor', 'Valor solicitado');
    echo $this->Confirmacao->parcelamento();
    echo $this->Confirmacao->termosDeServico();
    echo $this->Confirmacao->aceiteTermos();
    echo $this->Html->tag('br', null, array('class' => 'clear'));
    echo $this->Html->tag('/div');
    echo $this->Html->tag('/div');
    echo $this->Form->button('Próximo', array('class' => 'etapas-cadastro button radius'));
    echo $this->Form->end();

    