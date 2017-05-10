<?php

if(isset($_POST['newDataSubmitBtn'])) {
	dprint_r($_POST);
}

?>
<!-- START CONTENT -->

    <div class="row">
      <form class="form-horizontal" role="form" id="newDatasetForm" method="post">
        <fieldset>

          <!-- TankSelector -->
          <div class="form-group form-inline">
            <label class="control-label col-sm-3" for="newWaterTank">Tank</label>
            <div class="col-sm-6 input-group">
              <select id="newWaterTank" name="newWaterTank" class="form-control">
			  <?php
				foreach($_CFG['Tanks'] as $key => $tank) {
					echo "<option value=\"".$key."\">".$tank['name']." (".$tank['region'].", ".$tank['location'].")</option>";
				}
			  ?>
              </select>
            </div>
          </div>

		  <!-- Liter -->
          <div class="form-group form-inline">
            <label class="control-label col-sm-3" for="newWaterLiter">Liter</label>
            <div class="col-sm-6 input-group">
              <input id="newDataTemp" name="newDataTemp" class="form-control" placeholder="" type="text">
            </div>
            <button type="button" class="btn btn-default" aria-label="Stats">
              <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
            </button>
          </div>

         <!-- Buttons (Double) -->
         <div class="form-group form-inline">
           <div class="input-group col-sm-6">
             <button id="newDataSubmitBtn" name="newDataSubmitBtn" class="btn btn-success">Send</button>
             <button id="newDataClearBtn" name="newDataClearBtn" class="btn btn-danger">Clear</button>
           </div>
         </div> 

        </fieldset>
      </form>
    </div>

<!-- END CONTENT -->
