<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    unset($_SESSION['loggedIn']);
    header('Location: ./../client/index.php');
} else {
    header('Location: ./../client/'.$_SERVER['HTTP_REFERER'].'');
}
?>
</html>
