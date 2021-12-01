<?php
    //Add conditions for certain usernames for admins
    session_start();
    if (isset($_SESSION['username'])) {
        echo '<p> Placeholder text </p>';
        echo '<a href="../lab10/logout.php">Logout</a>';
    }
    else{
        echo '<p> This content is only available to users';
        echo '<a href="../lab10/login.php">Login</a>';
    }

?>