<?php
require('class.db.php');

$isSucceed = false;
$type = "";
$result1 = array();
$result2 = array();
if(isset($_GET["type"])){
  $type = $_GET["type"];  
  $query = "";
  if($type == "COMPLETED")
    $query = "SELECT DISTINCT companyName, interfereBy FROM `Transaction` WHERE pickupBy != ''";
  else
    $query = "SELECT DISTINCT companyName, interfereBy FROM `Transaction` WHERE pickupType = '". $type ."' AND pickupBy=''";
      
  $results = $database->get_results( $query );
  foreach( $results as $row )
  {
      array_push($result1, $row["companyName"]);
      array_push($result2, $row["interfereBy"]);
  }
  $isSucceed = true;
}
//if($type == "done"){
//  $query = "SELECT DISTINCT companyName FROM `Transaction` WHERE pickupBy != ''";
//  $results = $database->get_results( $query );
//  foreach( $results as $row )
//  {
//      array_push($result, $row["companyName"]);
//  }
//  $isSucceed = true;
//}else if($type == "emergency" || $type == "regular"){
//    $isEmergency = 0;
//    if($type == "emergency")$isEmergency=1;
//     $query = "SELECT DISTINCT companyName FROM `Transaction` WHERE isEmergency = " . $isEmergency;
//     $results = $database->get_results( $query );
//  foreach( $results as $row )
//  {
//      array_push($result, $row["companyName"]);
//  }
//  $isSucceed = true;
//}

sendResponse(200, json_encode(array('isSucceed' => $isSucceed, 'Company' => $result1, 'Interferer' => $result2)));
?>
