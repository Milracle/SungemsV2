<?php
require('class.db.php');

$emCount = 0;
$regCount = 0;
$doneCount = 0;
$isSucceed = true;

  $query = "SELECT DISTINCT pickupType, COUNT(pickupType) as Count FROM `Transaction` WHERE  isDeleted = false AND pickupBy = '' AND displayOnDate < '". getCurrentISTDate() ."' GROUP BY pickupType";
  $results = $database->get_results( $query );
if($results){
  foreach( $results as $row )
  {
     if($row["pickupType"] == "NORMAL") $regCount = $row["Count"];
     else if($row["pickupType"] == "EMERGENCY") $emCount = $row["Count"];
  }
}else{
    $isSucceed = false;
}

  $query = "SELECT COUNT(id) as Count FROM `Transaction` WHERE isDeleted = false AND displayOnDate < '". getCurrentISTDate() ."'  AND pickupBy != ''";
    $results = $database->get_row( $query );
    if($results){
         $doneCount = $results[0];
    }else{
        $isSucceed = false;
    }

sendResponse(200, json_encode(array('isSucceed' => $isSucceed, 'EmergencyCount' => $emCount, "RegularCount" => $regCount, "DoneCount" => $doneCount, "SyncDate" => getCurrentISTDate())));
?>
