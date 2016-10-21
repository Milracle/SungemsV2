<?php
require('class.db.php');

if(isset($_POST["transactionId"])){
$id = (int)($_POST["transactionId"]);
          $where_clause = array(
              'id' => $id
          );
          $deleted = $database->delete( 'Transaction', $where_clause, 1 );
        sendResponse(200, json_encode(array('isSucceed' => $deleted)));
}else{
    sendResponse(200, json_encode(array('isSucceed' => false)));
}
?>