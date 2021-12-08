<?php
  include './../server/db_conn.php';
  

  if($conn->connect_error){
	die("Connection failed");
  }
  else{
    if(!isset($_COOKIE["PHPSESSID"]))
    {
      session_start();
    }
  }

  if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT username FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss",$username,$password);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();


    if(!empty($result)){
          $_SESSION['admin_loggedin']= true;

          header("Location: ./../server/login.php");
          echo("logged in");
      }
      else {
          echo '<script type="text/javascript">alert("Invalid inputs. Please try again.");</script>';
          $_SESSION['admin_loggedin'] = false;
  }
}
  $conn->close();



 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Okanagan Bike Trails</title>
    <script type="text/javascript" src="src/client/js/main.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css' rel='stylesheet' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./../client/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>



</head>

<body>
    <?php
include 'header.php';
    ?>
<main>

<div class = "content-body">
<h1>Admin</h1>

<div>
<a href = "allcomments.php"><button class = "btn">View all comments</button></a>
<a href = "alltrails.php"><button class = "btn">View all trails</button></a>
</div>

</div>
</main>
<br><br><br><br><br><br><br><br><br><br>
</body>
    <?php

include 'footer.php';
    ?>
