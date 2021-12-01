<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require $root.'\\src\\server\\db_conn.php';

    // Get the user's name and make sure it's safe for both POST and GET
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['username'])){
            $username = mysqli_real_escape_string($connection, $_POST['username']);
        }
    }
    else {
        if (isset($_GET['username'])) {
            $username = mysqli_real_escape_string($connection, $_GET['username']);
        }
    }

    //Search database for username
    $sqlname = "SELECT * FROM users WHERE username='$username'";
    $query = mysqli_query($connection, $sqlname);

    if (mysqli_num_rows($query) === 1) {
        $result = mysqli_fetch_assoc($query);
        
        if ($result['username'] === $username ) {  
            echo "<fieldset><legend>User: ".$username."</legend>";
            echo "<table><tr><th>FirstName: ".$result['firstName']."</th></tr>";
            echo "<tr><th>LastName: ".$result['lastName']."</th></tr>";
            echo "<tr><th>Email: ".$result['email']."</th></tr>";
            echo "<tr><th>userID: ".$result['userID']."</th></tr>";
            echo "</fieldset></table>";
        }
    }

    $sql = "SELECT contentType, image FROM userimages where userID=?";
        //build the prepared statement SELECTing on the userID for the user
    $stmt = mysqli_stmt_init($connection);
        //init prepared statement object
    mysqli_stmt_prepare($stmt, $sql);
        //bind the query to the prepared statement
    mysqli_stmt_bind_param($stmt, "i", $result['userID']);
        //bind in the variable data (ie userID)
    mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
        //execute the query
    mysqli_stmt_bind_result($stmt, $type, $image); //bind in results
        //Binds the columns in the resultset to variables
    mysqli_stmt_fetch($stmt);
        //Fetches the blob and places it in the variable $image for use as well
        //as the image type (which is stored in $type)
    mysqli_stmt_close($stmt);
        //closes the prepared statement

    echo "<img src='data:uploads/".$type.";base64,".base64_encode($image)."'/>";
        //echo the image
?>