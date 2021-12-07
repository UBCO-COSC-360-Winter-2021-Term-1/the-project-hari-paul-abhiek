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
  <link rel="stylesheet" href="src/client/css/main.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

<?php
    include 'header.php';
    $root = $_SERVER["DOCUMENT_ROOT"];
    include $root . '/the-project-hari-paul-abhiek/src/server/db_conn.php';

    // Which trail post is being commented on?
    $id = $_GET['id'];
    $sql = "SELECT * FROM `trails` WHERE `trailID` = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['trailName'];
    $desc = $row['description'];
  ?>

<div class="container my-4">
    <div class="jumbotron">
        <h1 class="display-4"><?php echo $name;?></h1>
        <p class="lead">  <?php echo $desc;?></p>
        <hr class="my-4">
        <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members at all times.</p>
    </div>
</div>

<?php
    // Is the user logged in? Can only comment on posts if logged in
    if(isset($_SESSION['username'])) {
        $userName = $_SESSION['username'];
        // Create the form to submit a comment
        echo '<div class="container">
        <h1 class="py-2">Post a Comment</h1> 
        <form action= "'. $_SERVER['REQUEST_URI'] . '" method="post"> 
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form> 
    </div>';
    }
    else{
        echo '
        <div class="container">
        <h1 class="py-2">Post a Comment</h1> 
           <p class="lead">You are not logged in. Please login to be able to post comments.</p>
        </div>
        ';
    }

?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Insert into comment table
        $comment = $_POST['comment']; 
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment);

        date_default_timezone_set('America/Vancouver');
        $date = date('Y-m-d H:i:s', time());
        
        $sql = "INSERT INTO comment ( body, postid, username, commentdate) VALUES (?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, "siss", $comment, $id, $userName , $date);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $showAlert = true;
        }
    
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your comment has been added!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
        } 
    }

    
?>

<div class="container mb-5" id="ques">
        <h1 class="py-2">Discussions</h1>
    <?php
    
    $sql = "SELECT * FROM comment WHERE postid = $id"; 
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $cid = $row['cid'];
        $content = $row['body']; 
        $comment_user = $row['username']; 
        $comment_time = $row['commentdate']; 
        
        
        $sql2 = "SELECT * FROM users WHERE username = $comment_user";
        $result2 = mysqli_query($conn, $sql2);

        echo $conn;
        print_r($result2);

        $row2 = mysqli_fetch_assoc($result2);
        $email = $row2['email'];

        echo '<div class="media my-3">
            <img src="img/userdefault.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">
               <p class="font-weight-bold my-0">'. $email .' at '. $comment_time. '</p> '. $content . '
            </div>
        </div>';

        }

        // If no comments are on the page, display this message
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Comments Found</p>
                        <p class="lead"> Be the first person to comment</p>
                    </div>
                 </div> ';
        }

    ?> 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
