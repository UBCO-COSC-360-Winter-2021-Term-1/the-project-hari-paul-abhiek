<?php
    
    require 'validate.php';
    //session_start();
    //require 'db_conn.php';
// require './../client/js/validate.js';

    // Create variables for proper image path
    $target_dir = "./../client/img/";
    $target_file = $target_dir.basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    // Check if image file is an actual image or fake image
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES["userImage"]))
        {
            echo "file ok";
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, PNG, & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Only allow images under 1MB in size
    if ($_FILES["userImage"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // If image failed any of these requirements
    if ($uploadOk == 0) {
        echo "Your file was not uploaded to temp.";
        $pic = 0;
    }
    } 
    
    else {
        echo "no file";
    }
    if ($uploadOk)
    {
        $pic=1;
      //link for refering page
    if (isset($_SERVER['HTTP_REFERER']))
      $return_link = $_SERVER['HTTP_REFERER'];

      //check to see if user exists (based on username)
      //good connection, so do you thing
      //don't forget to escape '' either username or email
      $sql = "SELECT * FROM users where username = '$username' OR email = '$email';";

      $results = mysqli_query($conn, $sql);

      //and fetch requsults
      if ($row = mysqli_fetch_assoc($results))
      {
        echo "<p>User already exists with this name and/or email<p>";
        if (isset($return_link))
        {
          echo '<a href="'.$return_link.'">Return to user entry</a>';
        }
        //echo $row['username']." ".$row['firstName']." ".$row['lastName']." ".$row['email']." ".$row['password']."<br/>";
      }
      else {
        //insert user into table, and make sure to hash password!
        $sql = "INSERT INTO users (username, firstname, lastname, email, password,pic) values ('$username','$firstname','$lastname','$email','$hash','$pic'));";
          if (mysqli_query($conn, $sql))
          {
            $count = mysqli_affected_rows($conn);
            echo "<p>An account for the user $username has been created</p>";
          }

        $sql = "SELECT userID from users where username = '$username'";
        $results = mysqli_query($conn, $sql);
        while($row = $results->fetch_assoc()) {
          $userID =  $row["userID"];
        }
        echo "$userID";
        $imagedata = file_get_contents($_FILES['userImage']['tmp_name']);
        //$arr = ["hello!"];
        //$imagedata = gzcompress(json_encode($arr));
        //$sql = "INSERT INTO userImages (userID, image) values ('$userID','$imagedata);";
        $sql = "INSERT INTO userImages (userID, contentType, image, destination) VALUES(?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);  //init prepared statement object
        mysqli_stmt_prepare($stmt, $sql); // prepare the query
        $null = NULL;
        mysqli_stmt_bind_param($stmt, "isb", $userID, $imageFileType, $null, $_FILES["userImage"]["name"]); // You could replace $null with $data here and it also works
        mysqli_stmt_send_long_data($stmt, 2, $imagedata); // the magic. sending the binary data
        $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);

    /*      if (mysqli_query($connection, $sql))
          {
            $count = mysqli_affected_rows($connection);
            echo "<p>The image has been uploaded</p>";
          }*/
      }
      mysqli_free_result($results);
    }
  }
  else {
    //redirect
    echo "<p>Bad information has been entered</p>";
    if (isset($return_link))
    {
      echo '<a href="'.$return_link.'">Return to user entry</a>';
    }
  }

  mysqli_close($conn);

?>
</body>
</html>