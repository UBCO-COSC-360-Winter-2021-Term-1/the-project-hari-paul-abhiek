<?php
    session_start();
    require './../server/db_conn.php';

    $commentid = $_GET['id1'];
    $postid = $_GET['id2'];

    $sql = "SELECT * FROM comment WHERE cid = '$commentid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
?>