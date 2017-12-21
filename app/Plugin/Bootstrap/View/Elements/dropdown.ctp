<div class="dropdown">
	<?php
		 echo $this->Html->tag('button', $buttonLabel, $buttonOptions);
		 $options = array(
			  'class' => 'dropdown-menu',
			  'aria-labelledby' => $dropdownId,
		 );
		 echo $this->Html->nestedList($dropdownItens, $options);
	?>		
</div>