<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	echo mysql_error();

	# Import Configuration
	$cfgFile = "conf/ReefDB.json";
	$_CFG = json_decode(file_get_contents($cfgFile), true);

	# Import usefull stuff
	require_once("lib/stuff.lib.php");
	require_once("lib/html.lib.php");

	# Import Grapher
#	require_once("lib/grapher.class.php");
#	$g = new Grapher($_CFG['Grafana']);

	require_once("html/head.html");

	if(!empty($_GET["event"])) {
    	$e = $_GET["event"];
		switch($e) {
        	case "newData":
            	require_once("php/newData.php");
            	break;
        	case "newWater":
            	require_once("php/newWater.php");
            	break;
	        case "about":
    	        require_once("html/about.html");
        	    break;
			default:
            	require_once("php/newData.php");
      	}
   	}
   	else {
      	require_once("php/newData.php");
   	}

    require_once("html/modals.html");
   	require_once("html/foot.html");
?>
