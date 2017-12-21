<li role="presentation" class="<?= $item['active'] ? 'active' : 'disabled'; ?> <?= $item['current'] ? 'active-current' : ''; ?>">
	<a data-toggle="tab" role="tab" title="<?= $item['title']; ?>">
		<span class="round-tab">
			<i class="<?= $item['icon']; ?>"></i>
		</span>
	</a>
</li>