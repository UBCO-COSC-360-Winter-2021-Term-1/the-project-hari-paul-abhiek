<!DOCTYPE html>
<html>

<?php
 
 include 'validate.php';

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) 
    header('Location: ./../client/index.php');
else{

    function generateRandomSalt() {
        return base64_encode(random_bytes(12))  ;
    }

    function validateUser ($username, $password) {
        $sql = "SELECT password FROM users WHERE username='$username'";
        $result = mysqli_query($link, $sql); //execute the query
        if($row = mysqli_fetch_assoc($result)){
        
        //username exists, build second query with salt
        $salt = $row['Salt'];
        $saltSql = "SELECT userID FROM users WHERE username='$username'AND Password=MD5('$password$salt')";
        
        $finalResult = mysqli_query($link, $saltSql1);

        if($finalrow = mysqli_fetch_assoc($finalResult)){
        return true; 
        }

        return false; 
        
        }
			$sql = "SELECT username, password FROM users";
            $results = mysqli_query($conn, $sql);

			while ($row = mysqli_fetch_assoc($results)) {
				$uname = $row['username'];
				$pass = $row['password'];

				if($uname == $username && $password == $pass){
                    
					echo "Login Succesfull!";
                    $_SESSION['loggedIn'] = true;
                    header('Location: ./../client/index.php');
					break;
				}else
                $no_match_error = "Wrong username or password!";
                echo "<script type='text/javascript'>alert('$no_match_error');</script>";
			} 

    mysqli_free_result($results);
    mysqli_close($conn);
    }
    header('Location: ./../client/index.php');
}
?>
</html>