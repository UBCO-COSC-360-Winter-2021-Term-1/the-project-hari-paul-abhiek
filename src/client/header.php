<?php
  session_start();
  include "./../server/db_conn.php";
  
  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true){
    $loggedin= true;
  }
  else{
    $loggedin = false;
  }
  if(isset($_SESSION['admin_loggedIn']) && $_SESSION['admin_loggedIn']==true){
    $admin_loggedin= true;
  }else{
    $admin_loggedin = false;
  }
?>
<nav>
  <div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="./../client/index.php">Okanagan Bike Trails</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="./../client/index.php">Home</a>
    </li>
    <li class="nav-item ">
    <div class="dropdown">
      <button class="dropdown-toggle"  type="button" data-bs-toggle="dropdown" aria-expanded="false" >
        <a class="nav-link" href="./../client/trails.php" style="color:black">Trails</a>
      </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="trails.php"><b>View All Trails</b></a></li>

<?php
$sql = "SELECT * FROM `trails`";
if ($result = mysqli_query($conn, $sql)){ 
  while ($row = mysqli_fetch_assoc($result)) {
    $trail = $row['trailName'];
    $tid = $row['trailId'];
    echo'<li><a class="dropdown-item" href="./../client/comment.php?id='.$tid.'">'.$trail.'</a></li>';
  }
mysqli_free_result($result);
}
mysqli_close($conn);

?>

  </ul>
  </div>
  </li>

  <li class="nav-item">
      <a class="nav-link" href="./../client/photos.php">Photos</a>
  </li>
  <li class="nav-item">
      <a class="nav-link" href="./../client/about.php">About</a>
  </li>

  </ul>
  
  <div class="row mx-2">

  <ul class="navbar-nav mr-auto">
  <li class="nav-item">
  <form class= "form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        </li>
      <li class="nav-item"> 
  <button class="btn btn-outline-success my-2 my-sm-0"  inline="true" type="submit">Search</button>
  </li> 
  </form>

<?php
  if($loggedin == true){
   
    // $sql = "SELECT username, password FROM users";
    // if ($result = mysqli_query($conn, $sql)){ 
  
    //   while ($row = mysqli_fetch_assoc($results)) {
    //       $uname = $row['username'];
    //     }
    //     mysqli_free_result($result);
    //     }

      echo '<li class="nav-item">
              <a class="nav-link" href="./../server/logout.php">Logout</a>
            </li>';
      if (isset($_SESSION['pic']) && $_SESSION['pic'] == 0){
        echo '<li class="nav-item">
                <a class="nav-link" href="./../client/profile.php"><figure><img src="img/profile.png" alt="Profile" style="width:2em"></figure></a>
              <figcaption style="color:blue">'.$_SESSION['username'].'</figcaption>
              </li>';
      }else {
        echo '<li class="nav-item">
                <a class="nav-link" href="./../client/profile.php"><figure><img src="img/'.$_SESSION['profileImg'].'" alt="Profile" style="width:2em"></figure></a>
              <figcaption style="color:blue">'.$_SESSION['username'].'</figcaption>
              </li>';
      }

      if($admin_loggedin==true){
        echo '<li class="nav-item">
                <a class="nav-link" href="./../client/admin.php">Admin</a>
              </li>';
      }
      echo '</ul>';
    }
  
?>
<?php
      if($loggedin == false){
      echo '<li class="nav-item">
              <button class="btn btn-primary" inline="true" ><a href="./../server/login.php" style="color:white">Login</a></button>
            </li>
            <li class="nav-item"> 
              <button class="btn btn-primary" inline="true" ><a href="./../server/newuser.php" style="color:white">Sign Up</a></button>
            </li>
            </ul> ';
      }
      //session_destroy();
?>

  </div>
  </div>
  </div>
  </nav>
        
