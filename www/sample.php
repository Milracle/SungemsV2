<?php
require('class.db.php');

function downloadFile($url, $path)
{
    $newfname = $path;
    $file = fopen ($url, 'rb');

    if ($file) {
        $newf = fopen ($newfname, 'wb');
        if ($newf) {
            while(!feof($file)) {
                fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
            }
        }
    }
    if ($file) {
        fclose($file);
    }
    if ($newf) {
        fclose($newf);
    }
}

$templeName = $_GET["templeName"];
$srcUrl = $_GET["srcUrl"];

$index = $_GET["index"];
$isLast = $_GET["isLast"];
$darshanDate = $_GET["darshanDate"];

if($isLast == "true"){

  $query = "SELECT templeId FROM Temple WHERE templeName='$templeName'";
  $results = $database->get_results( $query );
  foreach( $results as $row )
  {
    $templeId = $row["templeId"];
    $sql = "SELECT * FROM DailyImage WHERE darshanDate='$darshanDate' AND templeId=$templeId";
    if ($database->num_rows($sql) == 0) {
      $totalImages = $index + 1;

      $names = array(
          'templeId' => $templeId,
          'darshanDate' => $darshanDate,
          'imageCount' => $totalImages
      );
      $add_query = $database->insert( 'DailyImage', $names );
      if( $add_query )
      {
        if($darshanDate == date("Y-m-d")){
          //Fields and values to update
          $update = array(
              'lastGeneratedDate' => $darshanDate
          );
          //Add the WHERE clauses
          $where_clause = array(
              'templeId' => $templeId
          );
          $updated = $database->update( 'Temple', $update, $where_clause, 1 );
          if( $updated )
          {
              //echo '<p>Successfully updated '.$where_clause['group_name']. ' to '. $update['group_name'].'</p>';
          }
        }
      }
    }
    break;
  }
}

// error_reporting( 0 );

$new_path = "../TempleImages/".$templeName;//.date('d-m-Y');

if(!file_exists($new_path)) {
    mkdir($new_path , 0777);
}

$new_path = "../TempleImages/".$templeName."/".$darshanDate;

if(!file_exists($new_path)) {
    mkdir($new_path , 0777);
}

$filepath = $new_path."/".($index+1).".jpg";

downloadFile($srcUrl, $filepath);

$thumbpath = $new_path."/". ($index+1)."_thumb.jpg";

createThumbnail(150,150,$filepath,$thumbpath);

$filepath = "Admin/".$filepath;

sendResponse(200, json_encode(array('isSucceed' => true, 'url' => $filepath, "index" => $index, "darshanDate" => $darshanDate, "templeName" => $templeName, "isLast" => $isLast)));

?>
