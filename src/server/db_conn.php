<?php

$host = "localhost";
$database = "project";
$user = "webuser";
$password = "P@ssw0rd";

$conn = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
?>