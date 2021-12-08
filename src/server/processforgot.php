<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include './../server/db_conn.php';

    // Get the user's name and make sure it's safe for both POST and GET
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['email'])){
            $email = mysqli_real_escape_string($conn, $_POST['email']);
        }
    }
    else {
        if (isset($_GET['email'])) {
            $email = mysqli_real_escape_string($conn, $_GET['email']);
        }
    }

    $sql = "SELECT email FROM `users`";
    if ($result = mysqli_query($conn, $sql)) {
      while ($row = mysqli_fetch_assoc($result)) {
        $email = $row['email'];
    }
    mysqli_free_result($result);
  }
  



    //Search database for username
    $sqlname = "SELECT password FROM users WHERE email='$email'";
    if($result = mysqli_query($conn, $sqlname)){

        while($row = mysqli_fetch_assoc($result)){
            $password=$row['password'];
        }
        mysqli_free_result($result);
    }
        $txt = "COSC 360 recover password";
        
           mail($email,$txt,$password);
           echo("<h1>unsd</h1>");
        
       // mysqli_free_result($result);
    
    mysqli_close($conn);
        //closes the prepared statement
?>