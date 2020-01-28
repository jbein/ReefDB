<?php

namespace App\Http\Controllers;

use TrayLabs\InfluxDB\Facades\InfluxDB;

class StatsController extends Controller {
    public function show($stat) {
        $result = InfluxDB::query('select '.$stat.'::field from data');
        $points = $result->getPoints();

        dd($points);

        return view('stats', [
            'stat' => $points
        ]);
    }
}
