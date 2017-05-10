<?php

function genTankSelector($_id, $tanks) {
	echo "<!-- TankSelector -->\r\n";
	echo "<div class=\"form-group form-inline\">\r\n";
	echo "  <label class=\"control-label col-md-3\" for=\"".$_id."\">Tank</label>\r\n";
	echo "  <div class=\"col-md-6 input-group\">\r\n";
	echo "    <select id=\"".$_id."\" name=\"".$_id."\" class=\"form-control\">\r\n";
    foreach($tanks as $key => $tank) {
    	echo "<option value=\"".$key."\">".$tank['name']." (".$tank['volume']." Liter, ".$tank['location'].")</option>\r\n";
    }
	echo "    </select>\r\n";
	echo "  </div>";
	echo "</div>";
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

function genButtonGroup($_submitName, $_clearName) {
	echo "<!-- Buttons -->\r\n";
	echo "<div class=\"form-group form-inline text-center\">\r\n";
	echo "  <div class=\"text-center\">\r\n";
	echo "    <button type=\"submit\" class=\"btn btn-success btn-md\" id=\"".$_submitName."\" name=\"".$_submitName."\">Submit</button>\r\n";
	echo "    <button type=\"reset\" class=\"btn btn-default btn-md\" id=\"".$_clearName."\" name=\"".$_clearName."\">Clear</button>\r\n";
	echo "  </div>\r\n";
	echo "</div>\r\n";
}

?>
