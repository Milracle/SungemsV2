<?php
require('class.db.php');

$isSucceed = false;
$type = "";
$result1 = array();
$result2 = array();
$haveNewData = true;
if(isset($_POST["type"])){

  if(isset($_POST["SyncDate"]) && $_POST["SyncDate"] != ""){
    $haveNewData = checkNewData($_POST["SyncDate"]);
  }

  if($haveNewData){
      $type = $_POST["type"];  
      $query = "";
      if($type == "COMPLETED")
        $query = "SELECT DISTINCT companyName, interfereBy FROM `Transaction` WHERE  isDeleted = false AND pickupBy != ''";
      else
        $query = "SELECT DISTINCT companyName, interfereBy FROM `Transaction` WHERE isDeleted = false AND pickupType = '". $type ."' AND pickupBy=''";

      $results = $database->get_results( $query );
      foreach( $results as $row )
      {
          array_push($result1, $row["companyName"]);
          array_push($result2, $row["interfereBy"]);
      }
      $isSucceed = true;
  }
}

sendResponse(200, json_encode(array('isSucceed' => $isSucceed, 'Company' => $result1, 'Interferer' => $result2, "SyncDate" => getCurrentISTDate())));
?>
