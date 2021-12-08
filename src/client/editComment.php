<?php
    session_start();
    require './../server/db_conn.php';

    $commentid = $_GET['id1'];
    $postid = $_GET['id2'];

    $sql = "SELECT * FROM comment WHERE postid = ? AND cid = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL FAILED')
            window.location.href='comment.php?id=$postid'</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "ii", $postid, $commentid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $comment = $row['body'];
            $commentdate = $row['commentdate'];
        }
        echo '<div class="container">
        <h1 class="py-2">Edit the Comment Below</h1> 
        <form action= "'. $_SERVER['REQUEST_URI'] . '" method="POST"> 
            <div class="form-group">
                <label for="comment">Commented at:'.$commentdate.'</label>
                <textarea class="form-control" id="comment" name="comment" rows="3">'.$comment.'</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Comment</button>
        </form> 
        </div>';
        // We only deal with POST requests to ensure data is secure
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Insert into comment table
            $comment = $_POST['comment']; 
            $comment = str_replace("<", "&lt;", $comment);
            $comment = str_replace(">", "&gt;", $comment);

            date_default_timezone_set('America/Vancouver');
            $date = date('Y-m-d H:i:s', time());
            
            $sql = "UPDATE comment SET body = '" . mysqli_real_escape_string($conn, $comment) . "' WHERE cid = '$commentid'";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                echo "<script type='text/javascript'>alert('Comment Updated')
                    window.location.href='comment.php?id=$postid'</script>";
            } else {
                echo "<script type='text/javascript'>alert('Comment Update Failed')
                    window.location.href='comment.php?id=$postid'</script>";
            }
        }
    }
    mysqli_close($conn);
?>