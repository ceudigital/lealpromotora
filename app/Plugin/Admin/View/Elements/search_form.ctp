<script type="text/javascript">
	$(function () {
		$(document).on('click', '#search-form button[type=reset]', function () {
			$(this).parents('form').find('input').val('');
			$(this).parents('form').submit();
		});
	});
</script>
<div class="m-b">
	<?php echo $this->Form->create($this->fetch('searchModel'), array('id' => 'search-form')); ?>
	<div class="input-group">
		<?php echo $this->Form->input('term_like', array('div' => false, 'label' => false, 'placeholder' => 'Pesquisar por nome ou CPF (sem pontuação)')); ?>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i> Pesquisar</button>
			<button type="reset" class="btn btn-white" title="Limpar pesquisa" data-toggle="tooltip"> <i class="fa fa-times"></i></button>
		</span>
	</div>
	<?php echo $this->Form->end(); ?>
</div>