<li>
	<a href="<?php echo Router::url($notification->getLink()) ?>" class="p-xxs">
		<div>
			<i class="<?= $notification->getIcon() ?>"></i> 
			<strong><?= $notification->getFrom(); ?></strong><br />
			<span class="text-muted"><?= $notification->getNotification(); ?></span>
		</div>
	</a>
	<span class="pull-right text-muted small"><i class="fa fa-clock-o"></i> <?php echo CakeTime::timeAgoInWords($notification->getDate()); ?></span>
</li>