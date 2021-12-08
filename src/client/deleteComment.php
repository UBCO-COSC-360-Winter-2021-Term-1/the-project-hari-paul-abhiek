<?php
    session_start();
    require './../server/db_conn.php';

    $commentid = $_GET['id1'];
    $postid = $_GET['id2'];

    $sql = "DELETE FROM comment WHERE postid = ? AND cid = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL FAILED')
            window.location.href='comment.php?id=$postid'</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "ii", $postid, $commentid);
        mysqli_stmt_execute($stmt);
        header("Location: comment.php?id=$postid");
        exit();
    }
    mysqli_close($conn);
    // header("Location: comment.php?id=$postid");
?>