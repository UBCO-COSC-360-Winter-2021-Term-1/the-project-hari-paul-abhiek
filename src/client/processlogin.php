<!DOCTYPE html>
<html>

<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
    header('Location: http://localhost/Project/src/client/index.html');
else{
$host = "localhost";
$database = "lab9";
$user = "root";
$password = "";

$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
else
{   
    if (isset($uname) && isset($password)) {
        if ($_SERVER['REQUEST_METHOD']== 'POST') {
            $uname = $_POST['username'];
            $password = $_POST['password'];
        }
        else {
           
            $uname = $_GET['username'];
            $password = $_GET['password'];
        }
    }else{
        echo "<h1>you left a field empty</h1>";
        echo '<a href=Login.php>Login</a>';
    }

    $password = md5($password);

			$sql = "SELECT username, password FROM users";
            $results = mysqli_query($connection, $sql);

			while ($row = mysqli_fetch_assoc($results)) {
				$username = $row['username'];
				$pass = $row['password'];

				if($uname == $username && $password == $pass){
                    
					echo "Login Succesfull!";
                    $_SESSION['loggedin'] = true;
                    header('Location: http://localhost/Project/src/client/index.html');
					break;
				}else
                echo ($uname);
                echo ($pass);
                echo "wrong pass or username";
			} 

    mysqli_free_result($results);
    mysqli_close($connection);
}

}

?>
</html>
