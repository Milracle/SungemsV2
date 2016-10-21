<?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $database = 'DailyDarshan';
//    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
//    if(! $conn )
//    {
//      die('Could not connect: ' . mysql_error());
//    }
//    mysql_select_db($database) or die(
// "Unable to select database");
//  mysql_close($conn);

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>
