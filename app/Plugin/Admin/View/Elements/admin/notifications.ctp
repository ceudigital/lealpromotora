<?php

	 $notifications = Notifications::read();
	 $count = count($notifications);
	 if (!empty($notifications)) {
		 echo <<<HTML
<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
	<i class="fa fa-bell"></i>  <span class="label label-danger">$count</span>
</a>
<ul class="dropdown-menu dropdown-alerts">
HTML;
		 foreach ($notifications as $notification) {
			 echo $this->element('Admin.admin/notification', compact('notification'));
		 }
		 echo '<li><a></a></li>';
		 echo '</ul>';
	 }
	 