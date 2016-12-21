<?php
require('class.db.php');

  $query = "UPDATE `Transaction` SET pickupType='EMERGENCY', modifiedDate='". getCurrentISTDate() ."' WHERE emergencyAfter<'". getCurrentISTDate() ."' AND pickupType='NORMAL'";

  $results = $database->query($query);
  echo $results;
?>
