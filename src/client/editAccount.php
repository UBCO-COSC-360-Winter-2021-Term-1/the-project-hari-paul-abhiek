<?php
  $connString = "mysql:host=localhost;dbname=project";
  $user = "webuser";
  $pass = "P@ssw0rd";
  $pdo = new PDO($connString, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    <script type="text/javascript">
  function checkPasswordMatch(e) {
    var password = $("#password").val();
    var confirmPassword = $("#password-check").val();
    if (password != confirmPassword){
      e.preventDefault();
      alert("Passwords do not match.");
      // Why aren't these working? Onload function but they should be loaded on submit!?

      makeRed($("#password"));
      makeRed($("#password-check"));
      
    } 
  };
</script>

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

<?php
echo'
<form method="post" action="editAccount.php" id="mainForm" enctype="multipart/form-data">
  First Name:<br>
  <input type="text" name="firstname" id="firstname" class="required">
  <br>
  Last Name:<br>
  <input type="text" name="lastname" id="lastname" class="required">
  <br>
  Username:<br>
  <input type="text" name="username" id="username" class="required"><?php echo $uname; ?>
  <br>
  email:<br>
  <input type="text" name="email" id="email" class="required">
  <br>
  Password:<br>
  <input type="password" name="password" id="password" class="required">
  <br>
  Re-enter Password:<br>
  <input type="password" name="password-check" id="password-check" class="required">
  <br>
  <input type="file" name="userImage" id="userImage" class="required"/>
  <br><br>
  <input type="submit" value="Update Account" onsubmit="checkPasswordMatch()">
</form>'
?>

    <?php
    } else {
        echo "<a href='./../server/login.php'>Must be logged in to edit account, click here to login</a>";
    }
    include 'footer.php';
    ?>
</body>

</html>