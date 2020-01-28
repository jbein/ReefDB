<?php

namespace App\Http\Controllers;

use TrayLabs\InfluxDB\Facades\InfluxDB;

class DataController extends Controller {
    public function showAll() {
        $result = InfluxDB::query('select * from data');
        $points = $result->getPoints();

        return view('data', [
            'points' => $points
        ]);
    }
}


/*
 *   0 => array:15 [
    "time" => "2017-06-15T08:51:45Z"
    "ca" => 451
    "kh" => null
    "mg" => null
    "nh3" => null
    "nh4" => 0.12
    "no2" => null
    "no3" => null
    "ph" => null
    "po4" => 0.013
    "salt" => null
    "sio2" => null
    "tankID" => "0"
    "temp" => 26
    "type" => "manual"
  ]
 */
