<?php
  include './../server/db_conn.php';
  

  if($conn->connect_error){
	die("Connection failed");
  }
  else{
	session_start();
  }

  if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT username FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss",$username,$password);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();


    //$sql="SELECT username FROM admin WHERE username='$username' AND password='$password'";
  //  $rs=$db->query($sql);

  //  $count=mysqli_num_rows($rs);


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
    <link rel="stylesheet" href="src/client/css/main.css">
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
<a href = "admin_users_button.php"><button class = "btn">Users</button></a>
<a href = "admin_posts_button.php"><button class = "btn">Posts</button></a>
</div>

</div>
</main>
</body>
    <?php

include 'footer.php';
    ?>
