<?php
require('class.db.php');

$isSucceed = false;
$companyName = "";
$result = array();
$haveNewData = true;

if(isset($_POST["companyName"]) && isset($_POST["isDone"])){
    
  if(isset($_POST["SyncDate"]) && $_POST["SyncDate"] != ""){
    $haveNewData = checkNewData($_POST["SyncDate"]);
  }
    
  if($haveNewData){
      $companyName = $_POST["companyName"];
      $isDone = $_POST["isDone"];
        $query = "";
        if($isDone == "true"){
            $query = "SELECT * FROM `Transaction` WHERE  isDeleted = false AND displayOnDate < '". getCurrentISTDate() ."'  AND pickupBy != '' AND companyName = '".$companyName."' ORDER BY `pickupType`";
        }else{
            $query = "SELECT * FROM `Transaction` WHERE  isDeleted = false AND displayOnDate < '". getCurrentISTDate() ."'  AND pickupBy = '' AND companyName = '".$companyName."' ORDER BY `pickupType`";
        }
      $results = $database->get_results( $query );
      foreach( $results as $row )
      {
          array_push($result, $row);
      }
      $isSucceed = true;
  }
}
 
sendResponse(200, json_encode(array('isSucceed' => $isSucceed, 'Values' => $result, "SyncDate" => getCurrentISTDate())));
?>
