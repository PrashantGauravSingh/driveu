<?php
 
require 'vendor/autoload.php';
$app = new \Slim\Slim();


$host = "127.0.0.1";
    $user = "prashantgauravsi";                     //Your Cloud 9 username
    $pass = "";                                 //Remember, there is NO password by default!
    $db = "geolat";                          //Your database name you want to connect to
    $port = 3306;                               //The port #. It is always 3306

    $connection = mysqli_connect($host, $user, $pass, $db, $port) or die(mysql_error());



$app->get('/:latitude/:longitude', function ($latitude,$longitude) {
 
   function isValidLatitude($latitude){
    if (preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/", $latitude)) {
        return true;
    } else {
        return false;
     }
  }
  
  function isValidLongitude($longitude){
    if(preg_match("/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}$/",
      $longitude)) {
       return true;
    } else {
       return false;
    }
  }

  if (isValidLatitude($latitude) and isValidLongitude($longitude)) 
      { global $connection;
          echo "Valid Coordinates";
      $sql = "INSERT INTO geoip (latitude, longitude)
VALUES ('$latitude', '$longitude')";

if ($connection->query($sql) === TRUE) {
    echo " New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      }
    
  
});
$app->run();
