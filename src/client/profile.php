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
    $connString = "mysql:host=localhost;dbname=project";
    $user = "webuser";
    $pass = "P@ssw0rd";
    $pdo = new PDO($connString, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ?>
    
        <!-- have to link to this after checking session variable user and seeing if they are logged in -->

        <!-- included all teh stuff above to make the doc work -->
        <!-- going to have the same style as main with the same header (reddit does this) -->

        <?php
        // $user = $_SESSION["user"];
        // $user = "this guy";
        //setting up variables
        if (isset($_SESSION['loggedIn'])) {
            $user = $_SESSION['loggedIn'];
            $test = $_SESSION['loggedIn'];

            // 
            //prints out all the session, very useful for testing
            // print_r($_SESSION);
            // 

        ?>
            <!-- checks if the user is logged in, used for testing -->
            <?php
            // if(empty($user)){
            //     echo "thing done";
            // }elseif(empty($test)){
            //     echo "thing not done";
            // }else{
            //     echo "damn dude";
            // }
            // echo $user;
            ?>
                <?php
                $sql = "SELECT * FROM users WHERE username = ?";
                $result = $pdo->prepare($sql);
                $result->execute(array($user));
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $user = $row['username'];
                    $fname = $row['firstName'];
                    $lname = $row['lastName'];
                    $email = $row['email'];



                    echo "<div>Username: " . $user . "</div>";
                    echo "<div>First Name: " . $fname . "</div>";
                    echo "<p>Last Name: " . $lname . "</p>";
                    echo "<p>Email: " . $email . "</p>";
                    echo '<p><img src="data:image/jpeg;base64,' . base64_encode($row['pic']) . '" alt="User missing a profile picture"/></p>';
                }
                ?>
                <div>
                <form action="editAccount.php" method="post">
                    <input type="submit" value="Edit Account">
                </form>
            </div>
            <?php
            //getting the posts that the logged in user has using session variable and a query
            $sql = "SELECT * FROM comment WHERE username =? ORDER BY commentdate DESC";
            $result0 = $pdo->prepare($sql);
            $result0->execute(array($user));
            if ($result0->rowCount() != 0) {
                while ($row0 = $result0->fetch()) {
                    //making the post id and body of the posts for the user 
                    echo '<div class="post">';
                    echo '<h3 class="post_title" id="' . $row0['commentid'] . '">' . $row0['title'] . '</h3>';
                    $length = strlen($row0['body']);
                    if ($length > 500) {
                        echo '<p class="post_content">' . substr($row0['body'], 0, 500) . '...</p>';
                    } else {
                        echo '<p class="post_content">' . $row0['body'] . '</p>';
                    }
                    // getting the comments count
                    $numComments = 0;
                    $commentQry = "SELECT COUNT(*) FROM comment WHERE postid=" . $row0['postid'];
                    $result1 = $pdo->query($commentQry);
                    while ($row1 = $result1->fetch()) {
                        $numComments = $row1['COUNT(*)'];
                    }
                    // using the comments count for the post info
                    $postdate = date_create($row0['postdate']);
                    echo '<p class="post_information">Comments: ' . $numComments . ', Username: ' . $row0['username'] . ', Posted on: ' . date_format($postdate, 'm/d/Y g:ia') . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<div class="post" id="demo">You have no posts yet! Clicke here to create your first post</div>';
            }
        } else {
            echo "<p>Must be logged in</p>";
            echo "<a href='./../server/login.php'>Click here to log in</a>";
        }
        $pdo = null;
            ?>

        

</body>

</html>