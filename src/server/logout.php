<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    unset($_SESSION['loggedin']);
    header('Location: ./../client/index.php');
} else {
    header('Location: ./../client/'.$_SERVER['HTTP_REFERER'].'');
}
?>
</html>
