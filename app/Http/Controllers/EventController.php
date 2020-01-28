<?php

namespace App\Http\Controllers;

use TrayLabs\InfluxDB\Facades\InfluxDB;

class EventController extends Controller {
    public function showAll() {
        $result = InfluxDB::query('select * from events');
        $points = $result->getPoints();

        return view('events', [
            'points' => $points
        ]);
    }
}
