<?php
include "./../server/db_conn.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Okanagan Bike Trails</title>
    <script type="text/javascript" src="src/client/js/main.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css' rel='stylesheet' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="src/client/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    include 'header.php';
    if (isset($_SESSION['loggedIn'])) {
        $session_uname = $_SESSION['loggedIn'];
        $uname = "";
        $fname = "";
        $lname = "";
        $email = "";
        $pass = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $uname = $_POST["uname"] ?? "";
            $lname = $_POST["lname"] ?? "";
            $fname = $_POST["fname"] ?? "";
            $email = $_POST["email"] ?? "";
            $pass = $_POST["pass"] ?? "";
        }
        //echo $uname . ", " . $fname . ", " . $lname . ", " . $email . ", " . $pass;
        if ($uname != "") {
            if (strlen($uname) > 0 && strlen($uname) <= 15) {
                $sql = "SELECT * FROM users WHERE username=?";
                $rslt = $pdo->prepare($sql);
                $rslt->execute(array($uname));
                if ($rslt->rowCount() == 0) {
                    $sql = "UPDATE users SET username=? WHERE username=?";
                    $rslt = $pdo->prepare($sql);
                    $rslt->execute(array($uname, $session_uname));
                    $_SESSION["loggedIn"] = $uname;
                }
            }
        }
        if ($fname != "") {
            if (strlen($fname) > 0 && strlen($fname) <= 20) {
                $sql = "UPDATE users SET firstName=? WHERE username=?";
                $rslt = $pdo->prepare($sql);
                $rslt->execute(array($fname, $session_uname));
            }
        }
        if ($lname != "") {
            if (strlen($lname) > 0 && strlen($lname) <= 20) {
                $sql = "UPDATE users SET lastName=? WHERE username=?";
                $rslt = $pdo->prepare($sql);
                $rslt->execute(array($lname, $session_uname));
            }
        }
        if ($email != "") {
            if (strlen($email) > 0 && strlen($email) <= 320 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql = "SELECT * FROM users WHERE email=?";
                $rslt = $pdo->prepare($sql);
                $rslt->execute(array($email));
                if ($rslt->rowCount() == 0) {
                    $sql = "UPDATE users SET email=? WHERE username=?";
                    $rslt = $pdo->prepare($sql);
                    $rslt->execute(array($email, $session_uname));
                }
            }
        }
        if ($pass != "") {
            if (strlen($pass) > 0 && strlen($pass) <= 30) {
                $sql = "UPDATE users SET password=? WHERE username=?";
                $rslt = $pdo->prepare($sql);
                $rslt->execute(array($pass, $session_uname));
            }
        }
        $sql = "SELECT * FROM users WHERE username=?";
        $rslt = $pdo->prepare($sql);
        $rslt->execute(array($session_uname));
        while ($row = $rslt->fetch()) {
            $uname = $row['username'];
            $fname = $row['firstName'];
            $lname = $row['lastName'];
            $email = $row['email'];
            $pass = $row['password'];
        }
    ?>
        <form action="editAccount.php" method="post" class="main_wrapper_editAccount">
            <label for="uname">Username: </label>
            <textarea name="uname" id="uname" cols="30" rows="1"><?php echo $uname; ?></textarea>
            <br>
            <label for="fname">First Name: </label>
            <textarea name="fname" id="fname" cols="30" rows="1"><?php echo $fname; ?></textarea>
            <br>
            <label for="lname">Last Name: </label>
            <textarea name="lname" id="lname" cols="30" rows="1"><?php echo $lname; ?></textarea>
            <br>
            <label for="email">Email: </label>
            <textarea name="email" id="email" cols="30" rows="1"><?php echo $email; ?></textarea>
            <br>
            <label for="pass">Password: </label>
            <textarea name="pass" id="pass" cols="30" rows="1"><?php echo $pass; ?></textarea>
            <input type="submit" value="Update Account">
        </form>
    <?php
    } else {
        echo "<a href='./../server/login.php'>Must be logged in to edit account, click here to login</a>";
    }
    include 'footer.php';
    ?>
</body>

</html>