<?php

$host = "cosc360.ok.ubc.ca";
$database = "db_60253655";
$user = "60253655";
$password = "60253655";

$conn = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
?>
