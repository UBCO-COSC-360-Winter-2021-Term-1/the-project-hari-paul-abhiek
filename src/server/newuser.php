<?php
    session_start();
    require 'validate.php';

    // Create variables for proper image path
    $target_dir = "./../client/img/";
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
    // Only allow images under 1MB in size
    if ($_FILES["userImage"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // If image failed any of these requirements
    if ($uploadOk == 0) {
        echo "Your file was not uploaded to temp.";
        $pic = 0;
    } else {
        if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {
            $msg = "The file ". htmlspecialchars( basename( $_FILES["userImage"]["name"])). " has been uploaded to the temp location";
            echo "<script type='text/javascript'>alert('$msg');</script>";
            $pic = 1;
        }
    }

    //Check if username exists
    $sqlname = "SELECT * FROM users WHERE username='$username'";
    $query = mysqli_query($conn, $sqlname);

    if (mysqli_num_rows($query) > 0) {
        $name_error = "Sorry... username already taken";
        echo "<script type='text/javascript'>alert('$name_error');</script>";
    } 
    else {
        // First SQL statement to insert new user
        $sql = "INSERT INTO users (username, firstName, lastName, email, password, pic) VALUES (?, ?, ?, ?, ?, ?);";
        
        if ($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, "sssssi", $username, $firstname, $lastname, $email, $hash, $pic);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $message = "User created successfully";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        

        // Second SQL statement to retrieve associated userID
        $sql2 = "SELECT userID FROM users WHERE username = ?";

        if ($stmt2 = mysqli_prepare($conn, $sql2))
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
            echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
        }
        
        // Third SQL statement to insert image path
        $imagedata = file_get_contents($target_file);
            // Store the contents of the files in memory in prep for upload

        $sql3 = "INSERT INTO userimages (userID, contentType, image, destination) VALUES (?, ?, ?, ?);";
            // create a new statement to insert to insert the image into the table. Recall
            // that the ? is a placeholder to variable data

        $stmt3 = mysqli_stmt_init($conn); //init prepared statement object
        mysqli_stmt_prepare($stmt3, $sql3); //register the query

        $null = NULL;
        mysqli_stmt_bind_param($stmt3, "isbs", $userID, $imageFileType, $null, $target_file); 


        mysqli_stmt_send_long_data($stmt3, 2, $imagedata); 

        $result = mysqli_stmt_execute($stmt3) or die(mysqli_stmt_error($stmt3)); 
        // execute the statement and store the result in $result

        mysqli_stmt_close($stmt3); 
        //close the statement

        $msg2 = "The file ". htmlspecialchars( basename( $_FILES["userImage"]["name"])). " has been uploaded to the server";
        echo "<script type='text/javascript'>alert('$msg2')
            window.location.href='./../client/index.php'</script>";
    }

    mysqli_close($conn);
?>