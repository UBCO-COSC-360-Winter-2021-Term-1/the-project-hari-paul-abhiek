<?php
  include './../server/db_conn.php';

  if($conn->connect_error){
	die("Connection failed");
  }
  else{
	session_start();
  }

  if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT username FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss",$username,$password);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();


    //$sql="SELECT username FROM admin WHERE username='$username' AND password='$password'";
  //  $rs=$db->query($sql);

  //  $count=mysqli_num_rows($rs);


    if(!empty($result)){
          $_SESSION['admin_loggedIn']= true;

          header("Location: admin_page.php");
          echo("logged in");
      }
      else {
          echo '<script type="text/javascript">alert("Invalid inputs. Please try again.");</script>';
          $_SESSION['admin_loggedIn'] = false;
  }
}
  $conn->close();



 ?>
<!DOCTYPE html>
<html>
    <body>
        
</body>

</html>