<?php
    session_start();
    require './../server/db_conn.php';


    $postid = $_GET['id'];

    $sql = "SELECT * FROM trails WHERE trailId = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL FAILED')
            window.location.href='alltrails.php'</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $postid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $trail = $row['trailName'];
            $desc= $row['description'];
        }
        echo '<div class="container">
        <h1 class="py-2">Edit the Trail Below</h1> 
        <form action= "'. $_SERVER['REQUEST_URI'] . '" method="POST"> 
            <div class="form-group">
                <label for="trail">Trail is:'.$trail.'</label>
                <textarea class="form-control" id="trail" name="trail" rows="6" cols="50">'.$desc.'</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Trail</button>
        </form> 
        </div>';

        // We only deal with POST requests to ensure data is secure
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Insert into trail table
            $desc2 = $_POST['trail']; 
            $desc2 = str_replace("<", "&lt;", $desc2);
            $desc2 = str_replace(">", "&gt;", $desc2);

           
            
            $sql = "UPDATE trails SET description = '" . mysqli_real_escape_string($conn, $desc2) . "' WHERE trailId = '$postid'";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                echo "<script type='text/javascript'>alert('Trail Updated')
                    window.location.href='alltrails.php'</script>";
            } else {
                echo "<script type='text/javascript'>alert('Trail Update Failed')
                    window.location.href='alltrails.php'</script>";
            }
        }
    }
    mysqli_close($conn);
?>