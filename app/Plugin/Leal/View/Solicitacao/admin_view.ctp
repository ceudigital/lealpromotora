<?php
    App::uses('Sexo', 'Lib');
    $this->extend('Admin.Common/empty');
    $this->assign('pageTitle', 'Solicitações');
    $this->assign('pageSubtitle', 'Solicistações');

    $this->Html->addCrumb('Solicitações', array('action' => 'index'));
    $this->Html->addCrumb($this->Solicitacao->id($solicitacao));
?>

<div class="row">
    <div class="wrapper wrapper-content">
        <div class="col-md-8">  
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-dados-pessoais" title="Dados pessoais"><i class="fa fa-user-o"></i></a></li>
                    <li><a data-toggle="tab" href="#tab-endereco" title="Endereço"><i class="fa fa-map-o"></i></a></li>
                    <li><a data-toggle="tab" href="#tab-documentos" title="Documentos"><i class="fa fa-id-card-o"></i></a></li>
                    <li><a data-toggle="tab" href="#tab-dados-bancarios" title="Dados bancários"><i class="fa fa-money"></i></a></li>
                    <li><a data-toggle="tab" href="#tab-imagens" title="Imagens"><i class="fa fa-file-image-o"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-dados-pessoais" class="tab-pane active">
                        <div class="panel-body">
                            <h2 class="no-margins">Dados pessoais</h2>
                            <hr class="m-t-xs" />
                            <?php
                                echo $this->Form->create('Solicitacao', array('type' => 'horizontal'));
                                echo $this->SolicitacaoView->input('nome');
                                echo $this->SolicitacaoView->input('telefone_fixo');
                                echo $this->SolicitacaoView->input('telefone_celular');
                                echo $this->SolicitacaoView->input('email', array('label' => 'E-mail'));
                                echo $this->SolicitacaoView->input('data_nascimento', array(
                                    'type' => 'text',
                                    'label' => 'Nascimento',
                                    'value' => CakeTime::format($solicitacao['Solicitacao']['data_nascimento'], '%d/%m/%Y')
                                ));
                                echo $this->SolicitacaoView->input('sexo', array(
                                    'value' => Sexo::get($solicitacao['Solicitacao']['sexo'])
                                ));
                                echo $this->SolicitacaoView->input('EstadoCivil.descricao', array('label' => 'Estado civil'));
                                echo $this->SolicitacaoView->input('nome_pai', array('label' => 'Nome do pai'));
                                echo $this->SolicitacaoView->input('nome_mae', array('label' => 'Nome da mãe'));
                                echo $this->Form->end();
                            ?>         
                        </div>
                    </div>
                    <div id="tab-endereco" class="tab-pane">
                        <div class="panel-body">
                            <h2 class="no-margins">Endereço</h2>
                            <hr class="m-t-xs" />
                            <?php
                                echo $this->Form->create('Solicitacao', array('type' => 'horizontal'));
                                echo $this->SolicitacaoView->input('cep', array('label' => 'CEP'));
                                echo $this->SolicitacaoView->input('endereco', array('label' => 'Endereço'));
                                echo $this->SolicitacaoView->input('numero', array('label' => 'Número'));
                                echo $this->SolicitacaoView->input('complemento');
                                echo $this->SolicitacaoView->input('bairro');
                                echo $this->SolicitacaoView->input('cidade');
                                echo $this->SolicitacaoView->input('estado');
                                echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                    <div id="tab-documentos" class="tab-pane">
                        <div class="panel-body">
                            <h2 class="no-margins">Documentos</h2>
                            <hr class="m-t-xs" />
                            <?php
                                echo $this->Form->create('Solicitacao', array('type' => 'horizontal'));
                                echo $this->SolicitacaoView->input('cpf', array('label' => 'CPF'));
                                echo $this->SolicitacaoView->input('rg', array('label' => 'RG'));
                                echo $this->SolicitacaoView->input('rg_emissao_estado', array('label' => 'RG/local de emissão'));
                                echo $this->SolicitacaoView->input('data_nascimento', array(
                                    'type' => 'text',
                                    'label' => 'RG/data de emissão',
                                    'value' => CakeTime::format($solicitacao['Solicitacao']['rg_emissao_data'], '%d/%m/%Y')
                                ));
                                echo $this->SolicitacaoView->input('matricula_beneficio', array('label' => 'Matrícula/Benefício'));
                                echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                    <div id="tab-dados-bancarios" class="tab-pane">
                        <div class="panel-body">
                            <h2 class="no-margins">Dados bancários</h2>
                            <hr class="m-t-xs" />
                            <?php
                                echo $this->Form->create('Solicitacao', array('type' => 'horizontal'));
                                echo $this->SolicitacaoView->input('Banco.descricao', array('label' => 'Banco'));
                                echo $this->SolicitacaoView->input('agencia', array('label' => 'Agência'));
                                echo $this->SolicitacaoView->input('conta', array('label' => 'Conta'));
                                echo $this->SolicitacaoView->input('conta_dv', array('label' => 'Conta/DV'));
                                echo $this->SolicitacaoView->input('TipoConta.descricao', array('label' => 'Tipo de conta'));
                                echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                    <div id="tab-imagens" class="tab-pane">
                        <div class="panel-body">
                            <h2 class="no-margins">Imagens</h2>
                            <hr class="m-t-xs" />
                            <?php echo $this->Solicitacao->documentos($solicitacao); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget style1 lazur-bg">
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-usd fa-5x"></i>
                    </div>
                    <div class="col-xs-10 text-right">
                        <span><?= $this->Solicitacao->campo($solicitacao, 'Coeficiente.Tabela.Orgao.descricao'); ?></span>
                        <h2 class="font-bold"><?= CakeNumber::currency($this->Solicitacao->campo($solicitacao, 'Solicitacao.valor'), 'BRL'); ?></h2>
                        <h3 class="font-bold no-margins">
                            <?= $this->Solicitacao->campo($solicitacao, 'Coeficiente.prazo'); ?> x
                            <?= CakeNumber::currency($this->Solicitacao->campo($solicitacao, 'Solicitacao.parcela'), 'BRL'); ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Status da solicitação</h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <?php echo $this->Solicitacao->progressoPreenchimento($solicitacao, 'Preenchimento %d%%', 'progress-small'); ?>
                        <?php echo $this->Solicitacao->progressoDocumentos($solicitacao, 'Documentos %d%%', 'progress-small'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>