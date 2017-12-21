<script type="text/javascript">
	jQuery(function(){
		jQuery('#AutenticacaoUsuarioCpf').mask('999.999.999-99');
	});   
</script>

<?php

   echo $this->Html->tag('h2', 'FORMULÁRIO ELETRÔNICO');
   echo $this->Html->tag('h3', 'APRESENTAÇÃO');
   echo $this->Html->tag('p', '
      O formulário eletrônico é uma ferramenta do Sistema informacional do Mapa Estratégico da Educação Superior (SIMEES), onde são cadastradas  e 
      processadas todas as informações necessárias para a geração do Plano de Desenvolvimento Institucional -PDI alinhado ao Plano de Desenvolvimento da(s)
      Unidade(s) ? PDUs de Instituições de Educação Superior (IES).
      <br/></br>
      O SIMEES é um instrumento auto-explicativo . O SIMEES disponibiliza ao usuário um manual explicativo de todas as fases, etapas e atividades que 
      constituem o sistema de gestão integrado para a administração da educação superior denominado Mapa Estratégico da Educação Superior (MEES).  
      <br/>
      Contém também um glossário de termos  sob a forma de perguntas e respostas de dúvidas pontuais que possa ter o usuário, tais como: o que é um PDI?, o 
      que é um PDU?, um NDE, entre outros conceitos relevantes para a efetividade do SIMEES. 
');
   echo $this->Html->tag('h3', 'TERMO DE COMPROMISSO E CONDUTA ÉTICA');
	echo $this->Form->create('AutenticacaoUsuario');
   echo $this->Form->input('cpf', array('label' => 'CPF'));
   echo $this->Form->input('nome', array('label' => 'Nome Completo'));
   echo $this->Form->input('email', array('label' => 'e-mail'));
   
   echo $this->Html->tag('p', '
      <strong>
      Considerando o disposto na legislação aplicável, declaro, pelo presente Termo de Conduta Ética, que na condição de usuário
      do Sistema informacional do Mapa Estratégico da Educação Superior (SIMEES), obrigo-me a:
      <br/><br/>
      I. firmar e seguir o presente termo de compromisso e conduta ética de usuário do SIMEES;
      <br/><br/>
      II. manter sob minha responsabilidade a(s) senha(s) de acesso aos sistemas de informação do SIMEES, pessoais e intransferíveis;
      <br/><br/>
      III. manter sigilo sobre as informações do SIMEES, disponibilizando-as exclusivamente aos órgãos competentes da IES;
      <br/><br/>
      IV. não promover atividades de consultoria, cursos e palestras, bem como não produzir materiais de orientação sobre os
      procedimentos de utilização do SIMEES;
      <br/><br/>
      V. atuar com urbanidade, probidade, idoneidade, comprometimento, seriedade e responsabilidade;
      </strong>
      ');
     
      echo $this->Html->tag('p', "Neste sentido, assumo perante a instituição mencionada abaixo, o compromisso de
      manter sigilo, conduta ética e proibidade no cadastro e/ou acesso como usuário do SIMEES.");
      echo $this->Form->input('mantida', array('label' => 'Instituição'));
   	echo '<br/>';
      echo $this->Form->input('concordo', array('type' => 'checkbox', 'label' => 'Concordo com o termo de compromisso e conduta ética acima apresentados.'));

      echo $this->Form->end('Continuar');
?>