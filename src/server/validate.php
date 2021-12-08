<?php
 require 'db_conn.php';

// Only using POST for client data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //For new user
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hash = md5($password);
    }
    //For login
    else if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hash = md5($password);
    }
}
else {
    throw new Exception('Invalid request');

    // if (isset($_GET['firstname']) && isset($_GET['lastname']) && isset($_GET['username']) && isset($_GET['email']) && isset($_GET['password'])) {
    //     $firstname = mysqli_real_escape_string($conn, $_GET['firstname']);
    //     $lastname = mysqli_real_escape_string($conn, $_GET['lastname']);
    //     $username = mysqli_real_escape_string($conn, $_GET['username']);
    //     $email = mysqli_real_escape_string($conn, $_GET['email']);
    //     $password = mysqli_real_escape_string($conn, $_GET['password']);
    //     $hash = md5($password);
    // }
    // else if (isset($_GET['username']) && isset($_GET['password'])) {
    //     $username = mysqli_real_escape_string($conn, $_GET['username']);
    //     $password = mysqli_real_escape_string($conn, $_GET['password']);
    //     $hash = md5($password);
    // }
} 
?>