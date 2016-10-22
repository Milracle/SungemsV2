<?php
require('class.db.php');

if(isset($_POST["transactionId"]) && isset($_POST["bankRate"]) && isset($_POST["totalPayment"])){
$id = (int)($_POST["transactionId"]);
$bankRate = $_POST["bankRate"];
$totalPayment = $_POST["totalPayment"];

    $update = array(
              'bankRate' => $bankRate,
              'totalPayment' => $totalPayment,
              'modifiedDate' => getCurrentISTDate()
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