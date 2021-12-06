<!DOCTYPE html>
<html>
<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    unset($_SESSION['loggedin']);
    header('Location: \\src\\client\\index.html');
} else {
    header('Location: \\src\\client\\'.$_SERVER['HTTP_REFERER'].'');
}
?>
</html>
