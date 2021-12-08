<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Okanagan Bike Trails</title>
  <script type="text/javascript" src="src/client/js/main.js"></script>
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css' rel='stylesheet' />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./../client/css/main.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

<?php
    include 'header.php';
    require './../server/db_conn.php';

     // Gather all info on the comment table in the database for Admin's use
    $sql = "SELECT * FROM comment ORDER BY commentdate DESC"; 
    $results = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($results)){
        
        $cid = $row['cid'];
        $content = $row['body']; 
        $post = $row['postid'];
        $comment_user = $row['username']; 
        $comment_time = $row['commentdate']; 

        $sql2 = "SELECT * FROM users WHERE `username` = '$comment_user'";
        $result2 = mysqli_query($conn, $sql2);

        $row2 = mysqli_fetch_assoc($result2);
        $comment_user_id = $row2['userID'];
        $email = $row2['email'];

        $sql3 = "SELECT * FROM trails WHERE `trailId` = '$post'";
        $result3 = mysqli_query($conn, $sql3);

        $row3 = mysqli_fetch_assoc($result3);
        $trail = $row3['trailName'];
        $desc = $row3['description'];

        $sql4 = "SELECT destination FROM userimages WHERE `userID` = '$comment_user_id'";
        $result4 = mysqli_query($conn, $sql4);

        $row4 = mysqli_fetch_assoc($result4);
        $destination = $row4['destination'];

        echo '<div class="media my-3">
            <img src="img/'.$destination.'" width="54px" class="mr-3" alt="...">
            <div class="media-body">
                <p class="font-weight-bold my-0">'.$comment_user.'('.$email.')'.' on '.$comment_time.' post:'.$trail.'</p> '. $content . '
                <a href="deleteComment.php?id1='.$cid.'&id2='.$post.'" style="float: right">Delete </a>;
                <a href="editComment.php?id1='.$cid.'&id2='.$post.'" style="float: right">Edit </a>;
            </div> 
            </div>';
    }

    mysqli_close($conn);
?>
<?php include 'footer.php';?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
</body>
</html>
