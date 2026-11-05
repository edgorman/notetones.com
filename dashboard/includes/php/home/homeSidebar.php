<?php	
	require(dirname(__FILE__)."/../dash/messaging/countMessages.php");
	require(dirname(__FILE__)."/../dash/tracks/countTrackUpdates.php");
	
   	echo '
		<li class="sidebar-brand">
			<a href="home.php"><i style="padding-top: 6px;" class="fa fa-tachometer"></i> Dashboard</a>
		</li>
		<li class="sidebar-brand">
			<a href="download.php"><i style="padding-top: 6px;" class="fa fa-tasks"></i> Download <span class="label label-default">'.$unseenUps.'</span></a>
		</li>
		<li class="sidebar-brand">
			<a href="production.php"><i style="padding-top: 6px;" class="fa fa-play"></i> Production Log</a>
		</li>
		<li class="sidebar-brand">
			<a href="messaging.php"><i style="padding-top: 6px;" class="fa fa-comments"></i> Messaging <span class="label label-default">'.$unseenMsgs.'</span></a>
		</li>
		<li class="sidebar-brand">
			<a href="invoice.php"><i style="padding-top: 6px;" class="fa fa-file-text"></i> Invoice Summary</a>
		</li>';
	
?>