<?php
	$ids 		= array( "nh4", "nh3", "ca", "kh", "mg", "no3", "no2", "po4", "ph", "sal", "sio2", "temp");
	$apiKey		= "eyJrIjoiZ2dscEM1ZUw2RmprR0ltc21oSVpRWGVsRVhjSzlPNVoiLCJuIjoiZXhwb3J0IiwiaWQiOjF9";
	$command 	= "curl -H 'Authorization: Bearer ".$apiKey."'";
	$imageDir 	= "../images";
	$imageURL	= "https://dash.janbein.de/render/dashboard-solo/db/reefdb?orgId=1&panelId=1&var-tankName=Reefer-170&theme=light&width=870&height=300";

	foreach($ids as $id) {
		exec($command." '".$imageURL."&var-field=".$id."' > ".$imageDir."/".$id.".png");
	}

?>
