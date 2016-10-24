<?php
require('class.db.php');

if(isset($_POST["transactionId"]) && isset($_POST["pickupBy"])){
$id = (int)($_POST["transactionId"]);
$pickupBy = $_POST["pickupBy"];

    $update = array(
              'pickupBy' => $pickupBy,
              'modifiedDate' => getCurrentISTDate(),
              'pickupDate' => getCurrentISTDate()
          );
          //Add the WHERE clauses
          $where_clause = array(
              'id' => $id
          );
          $updated = $database->update( 'Transaction', $update, $where_clause, 1 );
        sendResponse(200, json_encode(array('isSucceed' => $updated)));
}else{
    sendResponse(200, json_encode(array('isSucceed' => false)));
}
?>