<?php

if(isset($_POST['newDataSubmitBtn'])) {
	require("./vendor/autoload.php");

    $influx = InfluxDB\Client::fromDSN(
        sprintf('influxdb://'.$_CFG['InfluxDB']['username'].':'.$_CFG['InfluxDB']['password'].'@%s:%s/%s',
        $_CFG['InfluxDB']['host'],
        8086,
        $_CFG['InfluxDB']['database']));
    $client = $influx->getClient();

	$data = array();
	foreach($_POST as $key => $value) {
		if($key != "newDataTank" && $key != "newDataWater" && $key != "newDataWaterVolume" && $key != "newDataSubmitBtn") {
			if($value != null)
				$data[strtolower(str_replace('newData', '', $key))] = (float) str_replace(',', '.', $value);
		}
	}
	
	$dataPoint = new InfluxDB\Point(
		'data',
        null,
        ['name' => $_CFG['Tanks'][$_POST['newDataTank']]['name'], 
		'volume' => $_CFG['Tanks'][$_POST['newDataTank']]['volume'], 
        'location' => $_CFG['Tanks'][$_POST['newDataTank']]['location']],
        $data,
        exec('date +%s')
	);

	$waterPoint = "";
	if($_POST['newDataWater'] == 1) {
		$waterPoint = new InfluxDB\Point(
			'water',
    	    null,
	        ['name' => $_CFG['Tanks'][$_POST['newDataTank']]['name'],
            'volume' => $_CFG['Tanks'][$_POST['newDataTank']]['volume'],
			'location' => $_CFG['Tanks'][$_POST['newDataTank']]['location']],
	        array('volume' => (float) $_POST['newDataWaterVolume']),
            exec('date +%s')
        );
	}
	
	$points = array();
	if($dataPoint instanceof InfluxDB\Point)
		array_push($points, $dataPoint);

	if($waterPoint instanceof InfluxDB\Point)
		array_push($points, $waterPoint);

    $result = $influx->writePoints($points, InfluxDB\Database::PRECISION_SECONDS);
}

?>


    <div class="panel">
      <form class="form-horizontal" id="newDatasetForm" method="post">
        <fieldset>

<?php
	# Generate TankSelector
	genTankSelector("newDataTank", $_CFG['Tanks']);

	# Generate DataGroups
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

<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-md-3 control-label" for="newDataWater">Water Change?</label>
  <div class="col-md-6"> 
    <label class="radio-inline" for="newDataWater-0">
      <input type="radio" name="newDataWater" id="newDataWater-0" value="0" checked="checked">No
    </label> 
    <label class="radio-inline" for="newDataWater-1">
      <input type="radio" name="newDataWater" id="newDataWater-1" value="1">Yes
    </label> 
  </div>
</div>

<!-- Text input-->
<div class="form-group form-inline" id="newDataWaterVolumeDiv" style="display:none">
  <label class="col-md-3 control-label" for="newDataWaterVolume"></label>  
  <div class="col-md-6 input-group">
    <span class="input-group-addon"></span>
    <input id="newDataWaterVolume" name="newDataWaterVolume" type="text" placeholder="15" class="form-control input-md">
    <span class="input-group-addon">Liter</span>
  </div>
  <a class="btn btn-default btn-md" data-toggle="modal" data-target="#modalDataDetail" data-did="ca" data-dname="Calcium">
    <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
  </a>
</div>

<?php
	# Generate Buttons
	genButtonGroup("newDataSubmitBtn", "newDataClearBtn");
?>

        </fieldset>
      </form>
    </div>
