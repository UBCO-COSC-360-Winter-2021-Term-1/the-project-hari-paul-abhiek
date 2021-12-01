<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require $root.'\\src\\server\\validate.php';

    // Create variables for proper image path
    $target_dir = "uploads/";
    $target_file = $target_dir.basename($_FILES["userImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    // Check if image file is an actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["userImage"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
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
    // Only allow images under 100kb (CHANGE THIS MAYBE? WE SHOULD RESTRICT TO CERTAIN SIZES)
    if ($_FILES["userImage"]["size"] > 100000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // If image failed any of these requirements
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } 
    else {
        if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["userImage"]["name"])). " has been uploaded to the temp location. <br>";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    //Check if username exists
    $sqlname = "SELECT * FROM users WHERE username='$username'";
    $query = mysqli_query($connection, $sqlname);

    if (mysqli_num_rows($query) > 0) {
        $name_error = "Sorry... username already taken";
        echo "<script type='text/javascript'>alert('$name_error');</script>";
    } 
    else {
        // First SQL statement to insert new user
        $sql = "INSERT INTO users (username, firstName, lastName, email, password) VALUES (?, ?, ?, ?, ?);";
        
        if ($stmt = mysqli_prepare($connection, $sql))
        {
            mysqli_stmt_bind_param($stmt, "sssss", $username, $firstname, $lastname, $email, $hash);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $message = "User created successfully";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }

        // Second SQL statement to retrieve associated userID
        $sql2 = "SELECT userID FROM users WHERE username = ?";

        if ($stmt2 = mysqli_prepare($connection, $sql2))
        {
            mysqli_stmt_bind_param($stmt2, "s", $username);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result($stmt2, $userID);
            mysqli_stmt_fetch($stmt2);
            mysqli_stmt_store_result($stmt2);
            mysqli_stmt_close($stmt2);

        }
        else
        {
            echo "Error: " . $sql2 . "<br>" . mysqli_error($connection);
        }
        
        // Third SQL statement to insert image path
        $imagedata = file_get_contents($target_file);
            // Store the contents of the files in memory in prep for upload

        $sql3 = "INSERT INTO userimages (userID, contentType, image) VALUES (?, ?, ?);";
            // create a new statement to insert to insert the image into the table. Recall
            // that the ? is a placeholder to variable data

        $stmt3 = mysqli_stmt_init($connection); //init prepared statement object
        mysqli_stmt_prepare($stmt3, $sql3); //register the query

        $null = NULL;
        mysqli_stmt_bind_param($stmt3, "isb", $userID, $imageFileType, $null); 


        mysqli_stmt_send_long_data($stmt3, 2, $imagedata); 

        $result = mysqli_stmt_execute($stmt3) or die(mysqli_stmt_error($stmt3)); 
        // execute the statement and store the result in $result

        mysqli_stmt_close($stmt3); 
        //close the statement

        echo "The file ". htmlspecialchars( basename( $_FILES["userImage"]["name"])). " has been uploaded to the server. <br>";
    }

    mysqli_close($connection);
?>