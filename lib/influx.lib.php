<?php

    require("../vendor/autoload.php");

    $_CFG['InfluxDB']['username'] = "ReefDB";
    $_CFG['InfluxDB']['password'] = "ReefDB2017!";
    $_CFG['InfluxDB']['host']     = "localhost";
    $_CFG['InfluxDB']['database'] = "ReefDB";

    $influx = InfluxDB\Client::fromDSN(
        sprintf('influxdb://'.$_CFG['InfluxDB']['username'].':'.$_CFG['InfluxDB']['password'].'@%s:%s/%s',
        $_CFG['InfluxDB']['host'],
        8086,
        $_CFG['InfluxDB']['database']));
    $client = $influx->getClient();


    $points = [
        new InfluxDB\Point(
            'data',    // the name of the measurement
            null,       // measurement value
            ['name' => 'Reefer-170', 'region' => 'Loxstedt', 'location' => 'Livingroom'], // measurement tags
            ['nh3' => 8.0, 'nh3' => 7.0, 'sio2' => 0.1, 'ph' => 8.3, 'no2' => 0.01], // measurement fields
            exec('date +%s') // timestamp in nanoseconds on Linux ONLY
        )
    ];

    $result = $influx->writePoints($points, InfluxDB\Database::PRECISION_SECONDS);

/*
    $result = $influx->query('select * from water');

    // get the points from the resultset yields an array
    $points = $result->getPoints(); 

    print_r($points);
*/


?>
