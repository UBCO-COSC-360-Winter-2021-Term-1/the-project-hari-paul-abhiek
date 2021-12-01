<!DOCTYPE html>
<html>
<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    unset($_SESSION['loggedin']);
    header('Location: http://localhost/lab10/home.php');
    exit();
} else {
    header('Location: http://localhost/lab10/'.$_SERVER['HTTP_REFERER'].'');
    exit();
}
?>
</html>
