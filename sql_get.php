<?php
function open_connection() {
  if(strlen(getenv('OPENSHIFT_APP_NAME')) > 0){
    $YOUR_DATABASE_NAME = getenv('OPENSHIFT_APP_NAME');
    $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
    $user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
  } else {
    $YOUR_DATABASE_NAME = "php";
    $host = "localhost";
    $port = "3306";
    $user = "root";
    $password = "#r00tpass2";
  }

  $con = new mysqli($host, $user, $password, $YOUR_DATABASE_NAME, $port);
  if($con->connect_error) {
    die("Could not connect: " . mysqli_error($con));
  } else {
    // get_data_single_date($con,"");
    // $con->close();
    return $con;
  }
}

function get_data_single_date($con,$date) {
  $Count = "";
  //SELECT * FROM php.dontsmoke WHERE Date = '2016-05-15';
  $MySQL = "SELECT * FROM dontsmoke WHERE Date = '" . $date . "'";
  $query = $con->query($MySQL);
  if ($query->num_rows > 0) {
    $row = $query->fetch_assoc();
    $Count = $row["Count"];
  }
  return $Count;
}
?>
