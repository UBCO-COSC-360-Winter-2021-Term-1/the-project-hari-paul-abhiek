<?php
 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Okanagan Bike Trails</title>
    <script type="text/javascript" src="./../client/js/main.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css' rel='stylesheet' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="src/client/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
  function checkPasswordMatch(e) {
    var password = $("#password").val();
    var confirmPassword = $("#password-check").val();
    if (password != confirmPassword){
      e.preventDefault();
      alert("Passwords do not match.");

      makeRed($("#password"));
      makeRed($("#password-check"));
      
    } 
  };
</script>

</head>

<body>
    <?php
    include 'header.php';
    include './../server/db_conn.php';
    if (isset($_SESSION['loggedIn'])) {
        $session_uname = $_SESSION['loggedIn'];
        $uname = "";
        $fname = "";
        $lname = "";
        $email = "";
        $pass = "";
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $uname = $_POST["username"] ?? "";
            $lname = $_POST["lastname"] ?? "";
            $fname = $_POST["firstname"] ?? "";
            $email = $_POST["email"] ?? "";
            $pass = $_POST["password"] ?? "";
            $user=$_SESSION['username'];
        }
        //echo '$uname . ", " . $fname . ", " . $lname . ", " . $email . ", " . $pass;';
        $sql= "UPDATE `users` SET `firstName` = '$fname',
        `username` ='$uname', `lastName` = '$lname', `email` = '$email', `password`='$pass'
        WHERE `username` = '$user'";
    ?>
    <?php
    $result = mysqli_query($conn, $sql);
    $conn -> close();
    if (isset($_POST['submit']))
    {  
    header("Location: ./../client/index.php");
    }
    
    ?>


<form method="post" action="editAccount.php" class="main_wrapper_editAccount" enctype="multipart/form-data">
  First Name:<br>
  <input type="text" name="firstname" id="firstname" class="required">
  <br>
  Last Name:<br>
  <input type="text" name="lastname" id="lastname" class="required">
  <br>
  Username:<br>
  <input type="text" name="username" id="username" class="required">
  <br>
  email:<br>
  <input type="text" name="email" id="email" class="required">
  <br>
  Password:<br>
  <input type="password" name="password" id="password" class="required">
  <br>
  Re-enter Password:<br>
  <input type="password" name="password-check" id="password-check" class="required">

  <br><br>
  <input type="submit" name="submit" value="Update Account" onsubmit="checkPasswordMatch()">
</form>'


    <?php
    } else {
    echo "<a href='./../server/login.php'>Must be logged in to edit account, click here to login</a>";
    }
    include 'footer.php';
    ?>
</body>

</html>