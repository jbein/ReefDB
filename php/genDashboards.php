<?php
	$ids 		= array( "nh4", "nh3", "ca", "kh", "mg", "no3", "no2", "po4", "ph", "sal", "sio2", "temp");
	$apiKey		= "eyJrIjoiQ0NubGtHYTVvUUk5dmRGM3g3aVVVcXd5cDA2bVFiUGciLCJuIjoiZXhwb3J0IiwiaWQiOjF9";
	$command 	= "curl -H 'Authorization: Bearer ".$apiKey."'";
	$imageDir 	= "../images";
	$imageURL	= "https://dash.janbein.de/render/dashboard-solo/db/reefdb?orgId=1&panelId=1&var-tankName=Reefer-170&theme=light&width=870&height=300";

	foreach($ids as $id) {
		exec($command." '".$imageURL."&var-field=".$id."' > ".$imageDir."/".$id.".png");
	}

?>
