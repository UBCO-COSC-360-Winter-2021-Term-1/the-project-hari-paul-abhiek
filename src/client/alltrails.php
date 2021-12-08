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
    require './../server/db_conn.php';

    // Gather all info on the comment table in the database for Admin's use
    $sql = "SELECT * FROM trails ORDER BY trailId DESC"; 
    $results = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($results)){
        $trailId = $row['trailId'];
        $trailName = $row['trailName'];
        $desc = $row['description'];
        echo '<div class="media my-3">
        <div>
        <img src="img/card-'.$trailId.'.jpg" width="54px" class="mr-3" alt="...">
        <div class="media-body">
        <h5>'. $trail .'</h5>
            <p> '.$desc.'</p>;
        </div> 
        </div> 
        </div>';

    }
   
    $trailName=$_POST['trailname']; 
    $desc=$_POST['desc']; 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $sql = "INSERT INTO trails ( trailName, description) VALUES (?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, "ss", $trailName, $desc);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $showAlert = true;
        }
    }
    mysqli_close($conn);

    
?>



<form action="allTrails.php" method="post">
<input type="text" id="trailname" name="trailname" placeholder="add trail name HERE">
<input type="text" id="desc" name="desc" placeholder="add trail description HERE">
                    <input type="submit" value="add trail">
                </form>

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
