<?php
require('class.db.php');

if(isset($_POST["values"]) && isset($_POST["companyName"]) && isset($_POST["person"]) && isset($_POST["flag"])){
$values = json_decode($_POST["values"]);
$companyName = $_POST["companyName"];
$person = $_POST["person"];
$flag = $_POST["flag"];
    
    if($flag == "false"){
        $person = "";
    }
    foreach($values as $item) {
          $update = array(
              'pickupBy' => $person,
              'modifiedDate' => getCurrentISTDate(),
              'pickupDate' => getCurrentISTDate()
          );
          //Add the WHERE clauses
          $where_clause = array(
              'id' => $item
          );
          $updated = $database->update( 'Transaction', $update, $where_clause );
    }
          
    sendResponse(200, json_encode(array('isSucceed' => $updated)));
}else{
//    echo "FAILED";
    sendResponse(200, json_encode(array('isSucceed' => false)));
}
?>