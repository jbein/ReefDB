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
