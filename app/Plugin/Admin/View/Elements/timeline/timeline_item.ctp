<div class="vertical-timeline-block">
	<div class="vertical-timeline-icon <?= $class; ?>">
		<i class="<?= $icon; ?>"></i>
	</div>
	<div class="vertical-timeline-content">
		<?= $text; ?><br/>
		<span class="vertical-date small text-muted"><i class="fa fa-clock-o"></i> <?= CakeTime::format($date, '%d/%m/%Y %H:%M') ?></span>
	</div>
</div>