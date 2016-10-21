<?php
require('class.db.php');

$isSucceed = false;
$companyName = "";
$result = array();
if(isset($_GET["companyName"]) && isset($_GET["isDone"])){
  $companyName = $_GET["companyName"];
  $isDone = $_GET["isDone"];
    $query = "";
    if($isDone == "true"){
        $query = "SELECT * FROM `Transaction` WHERE pickupBy != '' && companyName = '".$companyName."' ORDER BY `pickupType`";
    }else{
        $query = "SELECT * FROM `Transaction` WHERE pickupBy = '' && companyName = '".$companyName."' ORDER BY `pickupType`";
    }
  $results = $database->get_results( $query );
  foreach( $results as $row )
  {
      array_push($result, $row);
  }
  $isSucceed = true;
}
 
sendResponse(200, json_encode(array('isSucceed' => $isSucceed, 'Values' => $result)));
?>
