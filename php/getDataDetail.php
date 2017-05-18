<?php
	echo "<div class=\"modal-header panel-heading\">";
   	echo "  <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
	echo "  <h4 class=\"modal-title\">Graph for ".$_POST['DNAME']." (".$_POST['DID'].")</h4>";
   	echo "</div>";

   	echo "<div class=\"modal-body\">";
  	echo "  <img src=\"images/".strtolower($_POST['DID']).".png\" alt=\"\"/>";
   	echo "</div>";   

   	echo "<div class=\"modal-footer\">";
   	echo "  <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>";
   	echo "</div>";

?>
