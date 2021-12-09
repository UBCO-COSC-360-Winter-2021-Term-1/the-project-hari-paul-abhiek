<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Okanagan Bike Trails</title>
  <script type="text/javascript" src="./../client/js/main.js"></script>
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css' rel='stylesheet' />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./../client/css/main.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>



</head>

<body>
  <?php
  $root = $_SERVER["DOCUMENT_ROOT"];
  include 'header.php';
  include $root . '/the-project-hari-paul-abhiek/src/server/db_conn.php';
  ?>

  <div class="container">
    <!-- <div class= "col"> -->
    <div class="row">


      <?php
      $sql = "SELECT * FROM `trails`";
      if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['trailId'];


          $trail = $row['trailName'];
          $desc = $row['description'];

          echo '<div class="card mx-auto m-3" style="width: 18rem">
              <img src="img/card-' . $id . '.jpg" class="card-img-top" alt="Card image cap">
              <div class="card-body">
                  <h5 class="card-title"><a href="comment.php?id=' . $id . '">' . $trail . '</a></h5>
                  <p class="card-text">' . substr($desc, 0, 90) . '... </p>
                  <a href="comment.php?id=' . $id . '" class="btn btn-primary">View trail</a>
              </div>
          
        </div>';

          if ($id % 3 == 0) {
            echo '</div><div class ="row">';
          }
        }
        mysqli_free_result($result);
      }
      mysqli_close($conn);


      ?>
    </div>
  </div>
  </div>
  <?php
  include 'footer.php';
  ?>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>