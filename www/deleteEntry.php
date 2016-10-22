<?php
require('class.db.php');

if(isset($_POST["transactionId"])){
      $id = (int)($_POST["transactionId"]);    
      $update = array(
            'isDeleted' => true,
            'modifiedDate' => getCurrentISTDate()
      );
      $where_clause = array(
          'id' => $id
      );
    
        $updated = $database->update( 'Transaction', $update, $where_clause );
        sendResponse(200, json_encode(array('isSucceed' => $updated)));
}else{
    sendResponse(200, json_encode(array('isSucceed' => false)));
}
?>