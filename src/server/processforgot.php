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

    //Search database for username
    $sqlname = "SELECT password FROM users WHERE email='$email'";
    if($result = mysqli_query($conn, $sqlname)){

        while($row = mysqli_fetch_assoc($result)){
            $pass=$row['password'];
        }
        mysqli_free_result($result);
    }

    $txt = "COSC 360 recover password";

    $newpass = "temp";

    if(isset($pass)){  
    mail($email,$txt,$password);
    echo("<h1>Recovery email sent to </h1>");
    echo($email);
    }
     else{
     echo("<h1>email not sent! please go back and try again</h1>");}
  
     mysqli_close($conn);
        //closes the prepared statement
?>
