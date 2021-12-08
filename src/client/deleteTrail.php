<?php
    session_start();
    require './../server/db_conn.php';

    
    $postid = $_GET['id'];

    $sql = "DELETE FROM trails WHERE trailId = ?";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL FAILED')
            window.location.href='alltrails.php'</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $postid);
        mysqli_stmt_execute($stmt);
        echo "<script type='text/javascript'>alert('You successfully deleted the trail')
            window.location.href='alltrails.php'</script>";
        
        exit();
    }
    mysqli_close($conn);
    // header("Location: comment.php?id=$postid");
?>