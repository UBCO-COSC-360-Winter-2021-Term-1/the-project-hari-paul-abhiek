<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Okanagan Bike Trails</title>
    <script type="text/javascript" src="src/client/js/main.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css' rel='stylesheet' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="src/client/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>



</head>

<body>
  <?php
    include 'header.php';
     include 'db_conn.php';
    //$root = realpath($_SERVER["DOCUMENT_ROOT"]);
 //require $root.'\\src\\server\\db_conn.php';
    ?>

<div class="container">
    <div class="row">


    <?php 
         $sql = "SELECT * FROM `trails`"; 
         if($result = mysqli_query($conn, $sql)){
         while($row = mysqli_fetch_assoc($result)){
          $id = $row['trailId'];
          $trail = $row['trailName'];
          $desc = $row['description'];
          echo '<div class="card mx-auto m-3>"
          <div class="card" style="width: 18rem;">
              <img src="img/card-'.$id. '.jpg" class="card-img-top" alt="Card image cap">
              <div class="card-body">
                  <h5 class="card-title"><a href="threadlist.php?id=' . $id . '">' . $trail . '</a></h5>
                  <p class="card-text">' . substr($desc, 0, 90). '... </p>
                  <a href="trails.php?id=' . $id . '" class="btn btn-primary">View trail</a>
              </div>
          </div>
        </div>';
         }
         mysqli_free_result($result);
        }
        
        mysqli_close($conn);
         
        
         ?> 
    </div>
    </div>

        <!-- <div class="card mx-auto m-3" style="width: 18rem;">
            <img class="card-img-top" src="img//myra-canyon.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Myra Canyon Trestles</h5>
              <p class="card-text">This 16km stretch will take you over 18 trestles and through two tunnels, all along the edge of a canyon with amazing views of Kelowna and Okanagan Lake. Since this trail was once part of a rail line it is virtually flat with no more than a 2% grade. </p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
    
          <div class="card mx-auto m-3" style="width: 18rem;">
          <img class="card-img-top" src="img//knox-mtn1.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Know Mountain Park</h5>
              <p class="card-text">Knox Mountain Park is better than ever, with new, mountain bike specific trails that range from fast and flowy wide-open singletrack to big jumps and steep, rocky descents.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
    
          <div class="card mx-auto m-3" style="width: 18rem;">
            <img class="card-img-top" src="img//crawford.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Myra-Bellevue Park(Crawford))</h5>
              <p class="card-text">Myra-Bellevue Provincial Park offers cross country, all mountain and downhill as it bodes the largest network of trails in the Central Okanagan.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
    
          <div class="card mx-auto m-3" style="width: 18rem;">
            <img class="card-img-top" src="img//gillard.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Gillard</h5>
              <p class="card-text">Gillard is a difficult and technically demanding downhill trail best suited for strong intermediate riders </p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
    
          <div class="card mx-auto m-3" style="width: 18rem;">
            <img class="card-img-top" src="img//powers.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Powers Creek</h5>
              <p class="card-text">Another downhill trail that bodes a fun group of trails that follow the ridge high above Powers Creek Canyon. Great views and fast, flowy, descents.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>

    <div class="row">
        <div class="card mx-auto m-3" style="width: 18rem;">
            <img class="card-img-top" src="img//powers.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Powers Creek</h5>
              <p class="card-text">A downhill trail with lots of man made features like a suspension bridge, a spiralling ramp, teeter-totters, skinnies.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
    
          <div class="card mx-auto m-3" style="width: 18rem;">
          <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
    
          <div class="card mx-auto m-3" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
    
          <div class="card mx-auto m-3" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
    
          <div class="card mx-auto m-3" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="card mx-auto m-3" style="width: 18rem;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
        
              <div class="card mx-auto m-3" style="width: 18rem;">
              <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
        
              <div class="card mx-auto m-3" style="width: 18rem;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
        
              <div class="card mx-auto m-3" style="width: 18rem;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
        
              <div class="card mx-auto m-3" style="width: 18rem;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div> -->
    <!-- Footer -->
    <footer class="page-footer font-small bg-light pt-4">

    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">
  
      <!-- Grid row -->
      <div class="row">
  
        <!-- Grid column -->
        <div class="col-md-6 mt-md-0 mt-3">
  
          <!-- Content -->
          <h5 class="text-uppercase">Footer Content</h5>
          <p>Here you can use rows and columns to organize your footer content.</p>
  
        </div>
        <!-- Grid column -->
  
        <hr class="clearfix w-100 d-md-none pb-3">
  
        <!-- Grid column -->
        <div class="col-md-3 mb-md-0 mb-3">
  
          <!-- Links -->
          <h5 class="text-uppercase">Links</h5>
  
          <ul class="list-unstyled">
            <li>
              <a href="#!">Link 1</a>
            </li>
            <li>
              <a href="#!">Link 2</a>
            </li>
            <li>
              <a href="#!">Link 3</a>
            </li>
            <li>
              <a href="#!">Link 4</a>
            </li>
          </ul>
  
        </div>
        <!-- Grid column -->
  
        <!-- Grid column -->
        <div class="col-md-3 mb-md-0 mb-3">
  
          <!-- Links -->
          <h5 class="text-uppercase">Links</h5>
  
          <ul class="list-unstyled">
            <li>
              <a href="#!">Link 1</a>
            </li>
            <li>
              <a href="#!">Link 2</a>
            </li>
            <li>
              <a href="#!">Link 3</a>
            </li>
            <li>
              <a href="#!">Link 4</a>
            </li>
          </ul>
  
        </div>
        <!-- Grid column -->
  
      </div>
      <!-- Grid row -->
  
    </div>
    <!-- Footer Links -->
  
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2021 Copyright:
      <a href="index.html"> OkanaganBikeTrails.com</a>
    </div>
    <!-- Copyright -->
  
    </footer>
    <!-- Footer -->


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