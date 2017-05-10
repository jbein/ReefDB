<?php

if(isset($_POST['newDataSubmitBtn'])) {
	require("./vendor/autoload.php");

    $influx = InfluxDB\Client::fromDSN(
        sprintf('influxdb://'.$_CFG['InfluxDB']['username'].':'.$_CFG['InfluxDB']['password'].'@%s:%s/%s',
        $_CFG['InfluxDB']['host'],
        8086,
        $_CFG['InfluxDB']['database']));
    $client = $influx->getClient();

    $data = array(
                'nh4'	=> (float) $_POST['newDataNH4'],
                'nh3' 	=> (float) $_POST['newDataNH3'],
                'ca' 	=> (float) $_POST['newDataCA'],
                'kh' 	=> (float) $_POST['newDataKH'],
                'mg' 	=> (float) $_POST['newDataMG'],
                'no3' 	=> (float) $_POST['newDataNO3'],
                'no2' 	=> (float) $_POST['newDataNO2'],
                'po4' 	=> (float) $_POST['newDataPO4'],
                'ph' 	=> (float) $_POST['newDataPH'],
                'salt' 	=> (float) $_POST['newDataSALT'],
                'sio2' 	=> (float) $_POST['newDataSIO2'],
                'temp' 	=> (float) $_POST['newDataTEMP']
            );

    $points = [
        new InfluxDB\Point(
            'data',
            null,
            ['name' => $_CFG['Tanks'][$_POST['newDataTank']]['name'], 
			 'volume' => $_CFG['Tanks'][$_POST['newDataTank']]['volume'], 
             'location' => $_CFG['Tanks'][$_POST['newDataTank']]['location']],
            $data,
            exec('date +%s')
        )
    ];

dprint_r($points);
    $result = $influx->writePoints($points, InfluxDB\Database::PRECISION_SECONDS);
}

function genDataGroup($_id, $_name, $_symbol, $_placeholder, $_unit) {
	echo "<!-- ".$_name." -->\r\n";
    echo "<div class=\"form-group form-inline\">\r\n";
    echo "  <label class=\"control-label col-md-3\" for=\"newDataNH4\">".$_name."</label>\r\n";
    echo "  <div class=\"col-md-6 input-group\">\r\n";
    echo "    <span class=\"input-group-addon\">".$_symbol."</span>\r\n";
    echo "    <input id=\"newData".strtoupper($_id)."\" name=\"newData".strtoupper($_id)."\" class=\"form-control\" placeholder=\"".$_placeholder."\" type=\"text\">\r\n";
    echo "    <span class=\"input-group-addon\">".$_unit."</span>\r\n";
    echo "  </div>\r\n";
    echo "  <a class=\"btn btn-default btn-md\" data-toggle=\"modal\" data-target=\"#modalDataDetail\" data-did=\"".$_id."\" data-dname=\"".$_name."\">\r\n";
    echo "    <span class=\"glyphicon glyphicon-stats\" aria-hidden=\"true\"></span>\r\n";
    echo "  </a>\r\n";
    echo "</div>\r\n";
	echo "\r\n";
}

?>

    <div class="panel">
      <form class="form-horizontal" id="newDatasetForm" method="post">
        <fieldset>

          <!-- TankSelector -->
          <div class="form-group form-inline">
            <label class="control-label col-md-3" for="newDataTank">Tank</label>
            <div class="col-md-6 input-group">
              <select id="newDataTank" name="newDataTank" class="form-control">
			  <?php
		      	foreach($_CFG['Tanks'] as $key => $tank) {
					echo "<option value=\"".$key."\">".$tank['name']." (".$tank['region'].", ".$tank['location'].")</option>";
				}
			  ?>
              </select>
            </div>
          </div>
<?php
	genDataGroup("nh4", "Ammonium", "NH<sub>4</sub>", "< 0.2", "mg/l");
	genDataGroup("nh3", "Ammonia", "NH<sub>3</sub>", "< 0.02", "mg/l");
	genDataGroup("ca", "Calcium", "Ca", "400 - 460", "mg/l");
	genDataGroup("kh", "Carbonate", "KH", "7 - 10", "°dH");
	genDataGroup("mg", "Magnesium", "Mg", "1200 - 1400", "mg/l");
	genDataGroup("no3", "Nitrate", "NO<sub>3</sub>", "2 - 10", "mg/l");
	genDataGroup("no2", "Nitrite", "NO<sub>2</sub>", "< 0.1", "mg/l");
	genDataGroup("po4", "Phosphate", "PO<sub>4</sub>", "0.03 - 0.04", "mg/l");
	genDataGroup("ph", "pH", "", "8.2 - 8.4", "");
	genDataGroup("salt", "Salinity", "", "1.022 - 1.024", "g/cm<sup>3</sup>");
	genDataGroup("sio2", "Silicate", "SiO<sub>2</sub>", "0.1 - 0.3", "mg/l");
	genDataGroup("temp", "Temperature", "", "23 -28", "&#8451;");
?>
          <!-- Button (Double) -->
          <div class="form-group form-inline">
            <button id="newDataSubmitBtn" name="newDataSubmitBtn" class="btn btn-success">Submit</button>
            <button id="newDataClearBtn" name="newDataClearBtn" class="btn btn-primary">Clear</button>
          </div>

        </fieldset>
      </form>
    </div>
