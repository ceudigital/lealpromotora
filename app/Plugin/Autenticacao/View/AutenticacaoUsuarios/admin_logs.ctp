<h2>Logs de utilização do sistema</h2>
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th style="width:20px;"><?php echo $this->Paginator->sort('#','id');?></th>
			<th><?php echo $this->Paginator->sort('Registro','model');?></th>
			<th><?php echo $this->Paginator->sort('Ação','action');?></th>
			<th><?php echo $this->Paginator->sort('Usuário','user_id');?></th>
			<th><?php echo $this->Paginator->sort('Data','created');?></th>
		</tr>
	</thead>
	<?php echo $this->element('index_tfoot', array('plugin' => 'sistema', 'colspan' => 7)); ?>
	<tbody>
		<?php
$i = 0;
foreach ($logs as $log):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
		<tr<?php echo $class;?>>
			<td><?php echo $log['Log']['id']; ?></td>
			<td style="text-align:center"><?php echo $log['Log']['model']; ?> (ID <?php echo $log['Log']['model_id']; ?>)</td>
			<td style="text-align:center"><?php echo $log['Log']['action']; ?></td>
			<td style="text-align:center"><?php echo $log['AutenticacaoUsuario']['name'] ? $log['AutenticacaoUsuario']['name'] : '<em>Usuário removido</em>'; ?></td>
			<td style="text-align:center"><?php echo date('d/m/Y H:i:s',strtotime($log['Log']['created'])); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>