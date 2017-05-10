<?php
	$to = time();
	$from = $to-604800; 

	$HEAD="Authorization: Bearer eyJrIjoiZ2dscEM1ZUw2RmprR0ltc21oSVpRWGVsRVhjSzlPNVoiLCJuIjoiZXhwb3J0IiwiaWQiOjF9";
	$URL="https://dash.janbein.de/dashboard/db/reefdb?orgId=1&panelId=1&var-tankName=Reefer%20170&var-field=mg";
	$URL2="https://dash.janbein.de/dashboard-solo/db/reefdb?orgId=1&panelId=1&var-tankName=Reefer%20170&var-field=temp&theme=light";

	echo "<iframe src=\"\" /> width=\"450\" height=\"200\" frameborder=\"0\"></iframe>";
?>

<! --
<iframe src="https://dash.janbein.de/dashboard-solo/db/reefdb?orgId=1&panelId=1&var-tankName=Reefer%20170&var-field=temp&theme=light" width="450" height="200" frameborder="0"></iframe>
-->
