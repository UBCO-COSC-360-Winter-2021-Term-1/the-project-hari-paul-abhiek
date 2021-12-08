<!DOCTYPE html>
<html lang="en">

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
    include './../server/db_conn.php';
    ?>

        <?php
        if (isset($_SESSION['loggedIn'])) {
            $user = $_SESSION['loggedIn'];
            $test = $_SESSION['loggedIn'];
            $user2=$_SESSION['username'];
            $user3 = "";
            $fname = "";
            $lname = "";
            $email = "";

        ?>
            <?php
            
            ?>
                <?php
                $sql = "SELECT * FROM `users` WHERE `username` = '$user2'";
                if($result = mysqli_query($conn, $sql)){
                while ($row = mysqli_fetch_assoc($result)) {
                    $user3 = $row['username'];
                    echo $user3;
                    $fname = $row['firstName'];
                    $lname = $row['lastName'];
                    $email = $row['email'];
                }
                   // mysqli_free_result($result);   
            
                    

                    echo "<div>Username: " . $user3 . "</div>";
                    echo "<div>First Name: " . $fname . "</div>";
                    echo "<p>Last Name: " . $lname . "</p>";
                    echo "<p>Email: " . $email . "</p>";
            }
            
                   // echo '<p><img src="img/jpg; base64,' . base64_encode($row['pic']) . '" alt="User missing a profile picture"/></p>';
                }
                ?>
                <div>
                <form action="editAccount.php" method="post">
                    <input type="submit" value="Edit Account">
                </form>
<br>
<br>
<br>
<br>
                <form action="./../server/updatePicture.php" method="post">
                <input type='file' name='userImage' id='userImage' class='required'/>
                <input type="submit" value="upload profile picture">
                </form>
            </div>
            <?php
            mysqli_close($conn);
            ?>

        

</body>

</html>