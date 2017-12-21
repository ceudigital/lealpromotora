<script type="text/javascript">
	jQuery(function(){
		jQuery('#AutenticacaoUsuarioCpf').mask('999.999.999-99');
	});   
</script>

<?php

   echo $this->Html->tag('h2', 'FORMUL�RIO ELETR�NICO');
   echo $this->Html->tag('h3', 'APRESENTA��O');
   echo $this->Html->tag('p', '
      O formul�rio eletr�nico � uma ferramenta do Sistema informacional do Mapa Estrat�gico da Educa��o Superior (SIMEES), onde s�o cadastradas  e 
      processadas todas as informa��es necess�rias para a gera��o do Plano de Desenvolvimento Institucional -PDI alinhado ao Plano de Desenvolvimento da(s)
      Unidade(s) ? PDUs de Institui��es de Educa��o Superior (IES).
      <br/></br>
      O SIMEES � um instrumento auto-explicativo . O SIMEES disponibiliza ao usu�rio um manual explicativo de todas as fases, etapas e atividades que 
      constituem o sistema de gest�o integrado para a administra��o da educa��o superior denominado Mapa Estrat�gico da Educa��o Superior (MEES).  
      <br/>
      Cont�m tamb�m um gloss�rio de termos  sob a forma de perguntas e respostas de d�vidas pontuais que possa ter o usu�rio, tais como: o que � um PDI?, o 
      que � um PDU?, um NDE, entre outros conceitos relevantes para a efetividade do SIMEES. 
');
   echo $this->Html->tag('h3', 'TERMO DE COMPROMISSO E CONDUTA �TICA');
	echo $this->Form->create('AutenticacaoUsuario');
   echo $this->Form->input('cpf', array('label' => 'CPF'));
   echo $this->Form->input('nome', array('label' => 'Nome Completo'));
   echo $this->Form->input('email', array('label' => 'e-mail'));
   
   echo $this->Html->tag('p', '
      <strong>
      Considerando o disposto na legisla��o aplic�vel, declaro, pelo presente Termo de Conduta �tica, que na condi��o de usu�rio
      do Sistema informacional do Mapa Estrat�gico da Educa��o Superior (SIMEES), obrigo-me a:
      <br/><br/>
      I. firmar e seguir o presente termo de compromisso e conduta �tica de usu�rio do SIMEES;
      <br/><br/>
      II. manter sob minha responsabilidade a(s) senha(s) de acesso aos sistemas de informa��o do SIMEES, pessoais e intransfer�veis;
      <br/><br/>
      III. manter sigilo sobre as informa��es do SIMEES, disponibilizando-as exclusivamente aos �rg�os competentes da IES;
      <br/><br/>
      IV. n�o promover atividades de consultoria, cursos e palestras, bem como n�o produzir materiais de orienta��o sobre os
      procedimentos de utiliza��o do SIMEES;
      <br/><br/>
      V. atuar com urbanidade, probidade, idoneidade, comprometimento, seriedade e responsabilidade;
      </strong>
      ');
     
      echo $this->Html->tag('p', "Neste sentido, assumo perante a institui��o mencionada abaixo, o compromisso de
      manter sigilo, conduta �tica e proibidade no cadastro e/ou acesso como usu�rio do SIMEES.");
      echo $this->Form->input('mantida', array('label' => 'Institui��o'));
   	echo '<br/>';
      echo $this->Form->input('concordo', array('type' => 'checkbox', 'label' => 'Concordo com o termo de compromisso e conduta �tica acima apresentados.'));

      echo $this->Form->end('Continuar');
?>