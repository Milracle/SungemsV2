<?php
require('class.db.php');

if(isset($_POST["values"]) && isset($_POST["type"]) && isset($_POST["interferer"]) && isset($_POST["flag"])){
$values = json_decode($_POST["values"]);
$type = $_POST["type"];
$interferer = $_POST["interferer"];
$flag = $_POST["flag"];
    if($flag == "false"){
        $interferer = "";
    }
    foreach($values as $item) {
          $update = array(
            'interfereBy' => $interferer,
            'modifiedDate' => getCurrentISTDate()
          );
          //Add the WHERE clauses
          $where_clause = array(
              'companyName' => $item
          );
          $updated = $database->update( 'Transaction', $update, $where_clause );
    }
          
    sendResponse(200, json_encode(array('isSucceed' => $updated)));
}else{
//    echo "FAILED";
    sendResponse(200, json_encode(array('isSucceed' => false)));
}
?>