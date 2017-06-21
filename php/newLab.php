<?php

if(isset($_POST['newDataSubmitBtn'])) {
    require("./vendor/autoload.php");

    $influx = InfluxDB\Client::fromDSN(
        sprintf('influxdb://'.$_CFG['InfluxDB']['username'].':'.$_CFG['InfluxDB']['password'].'@%s:%s/%s',
        $_CFG['InfluxDB']['hostname'],
        8086,
        $_CFG['InfluxDB']['database']));
    $client = $influx->getClient();

	$waterPoint = new InfluxDB\Point(
    	'laboratory',
        null,
        ['name' => $_CFG['Tanks'][$_POST['newLabTank']]['name'],
        'volume' => $_CFG['Tanks'][$_POST['newLabTank']]['volume'],
        'location' => $_CFG['Tanks'][$_POST['newLabTank']]['location']],
        array('volume' => (float) $_POST['newLabWATER']),
        exec('date +%s')
    );

    $points = array();
    if($waterPoint instanceof InfluxDB\Point)
        array_push($points, $waterPoint);

dprint_r($_POST);       
#    $result = $influx->writePoints($points, InfluxDB\Database::PRECISION_SECONDS);
}

?>
<!-- START CONTENT -->

    <div class="row">
      <form class="form-horizontal" role="form" id="newDatasetForm" method="post">
        <fieldset>

<?php
    # Generate TankSelector
    genTankSelector("newLabTank", $_CFG['Tanks']);

	# Generate FormGroups
    genDataGroup("Water", "Water", "", "20", "Liter");

    # Generate Buttons
    genButtonGroup("newLabSubmitBtn", "newLabClearBtn");
?>

        </fieldset>
      </form>
    </div>

<!-- END CONTENT -->
