<?php

    require("../vendor/autoload.php");
	require("../lib/stuff.lib.php");

	function setRandValue(&$_array, $_id, $_value) {
		if(rand(0,1) == 1)
			$_array[$_id] = $_value;
	}

    $_CFG['InfluxDB']['username'] = "ReefDB";
    $_CFG['InfluxDB']['password'] = "ReefDB2017!";
    $_CFG['InfluxDB']['host']     = "localhost";
    $_CFG['InfluxDB']['database'] = "ReefDB";

    $influx = InfluxDB\Client::fromDSN(
        sprintf('influxdb://'.$_CFG['InfluxDB']['username'].':'.$_CFG['InfluxDB']['password'].'@%s:%s/%s',
        $_CFG['InfluxDB']['host'],
        8086,
        $_CFG['InfluxDB']['database'])
	);
    $client = $influx->getClient();

	$points = array();
	for($i=0; $i<50; $i++) {		
		$time = exec('date +%s');
		$time = $time - ((49-$i)*604800);

		$data = array();		
		setRandValue($data, 'nh4', (float) rand(10,20)/100);
		setRandValue($data, 'nh3', (float) rand(10,20)/1000);
		setRandValue($data, 'ca', (float) rand(400,460));
		setRandValue($data, 'kh', (float) rand(7,10));
		setRandValue($data, 'mg', (float) rand(1200,1400));
		setRandValue($data, 'no3', (float) rand(0,10));
		setRandValue($data, 'no2', (float) rand(1,10)/100);
		setRandValue($data, 'po4', (float) rand(10,50)/1000);
		setRandValue($data, 'ph', (float) rand(75,85)/10);
		setRandValue($data, 'salt', (float) rand(1018,1032)/1000);
		setRandValue($data, 'sio2', (float) rand(10,30)/100);
		setRandValue($data, 'temp', (float) rand(23,28));

		$points[$i] = new InfluxDB\Point(
            'data',
            null,
            ['name' => 'Reefer170', 'volume' => '165', 'location' => 'Livingroom'],
            $data,
            $time
        );

		if($i%3==0) {
			$points[$i+100] = new InfluxDB\Point(
	            'water',
	            null,
        	    ['name' => 'Reefer170', 'volume' => '165', 'location' => 'Livingroom'],
    	        array('volume' => (float) rand(10,50)),
	            $time
	        );
		}		
	}

#	dprint_r($points);
    $result = $influx->writePoints($points, InfluxDB\Database::PRECISION_SECONDS);

?>
