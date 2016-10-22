<?php
require('class.db.php');

$str = $_POST["string"];

$arrValues = explode("~",$str);
$arrLength = count($arrValues);
$buyer = $_POST["buyer"];
if($arrLength == 19){
  $date_utc = new DateTime(null, new DateTimeZone("UTC"));
  $date_utc->setTimezone(new DateTimeZone('Asia/Kolkata'));
  $created_date=date_format($date_utc, 'Y-m-d H:i:s');
    
  $pickupAfterDays = "P".$arrValues[17]."D";    
    
  $displayOnDate =  new DateTime(null, new DateTimeZone("UTC"));
  $displayOnDate->setTimezone(new DateTimeZone('Asia/Kolkata'));
  $displayOnDate->add(new DateInterval($pickupAfterDays));
  $displayOnDate=date_format($displayOnDate, 'Y-m-d H:i:s');
    
  $values = array(
      'companyName' => $arrValues[0],
      'GIA' => $arrValues[1],
      'stockNumber' => $arrValues[2],
      'size' => $arrValues[3],
      'color' => $arrValues[4],
      'purity' => $arrValues[5],
      'cut' => $arrValues[6],
      'polish' => $arrValues[7],
      'symmetry' => $arrValues[8],
      'fluorescence' => $arrValues[9],
      'RAP' => $arrValues[10],
      'discount' => $arrValues[11],
      'less' => $arrValues[12],    
      'bill' => $arrValues[13],
      'bankRate' => $arrValues[14],
      'totalPayment' => $arrValues[15],
      'pickupType' => $arrValues[16],
      'pickupAfterDays' => $arrValues[17],
      'comment' => $arrValues[18],      
      'createdDate' =>  $created_date,//date("Y-m-d H:i:s"),
      'modifiedDate' =>  $created_date,//date("Y-m-d H:i:s"),
      'purchaseBy' => $buyer,
      'displayOnDate' => $displayOnDate
  );
  $add_query = $database->insert( 'Transaction', $values );

  sendResponse(200, json_encode(array('isSucceed' => $add_query)));
}
?>
