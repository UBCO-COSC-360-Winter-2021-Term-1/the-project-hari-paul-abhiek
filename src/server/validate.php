<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require $root.'\\src\\server\\db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $hash = md5($password);
    }
    else if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $hash = md5($password);
    }
}
else {
    if (isset($_GET['firstname']) && isset($_GET['lastname']) && isset($_GET['username']) && isset($_GET['email']) && isset($_GET['password'])) {
        $firstname = mysqli_real_escape_string($connection, $_GET['firstname']);
        $lastname = mysqli_real_escape_string($connection, $_GET['lastname']);
        $username = mysqli_real_escape_string($connection, $_GET['username']);
        $email = mysqli_real_escape_string($connection, $_GET['email']);
        $password = mysqli_real_escape_string($connection, $_GET['password']);
        $hash = md5($password);
    }
    else if (isset($_GET['username']) && isset($_GET['password'])) {
        $username = mysqli_real_escape_string($connection, $_GET['username']);
        $password = mysqli_real_escape_string($connection, $_GET['password']);
        $hash = md5($password);
    }
} 
?>