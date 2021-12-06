<!DOCTYPE html>
<html>

<?php
 $root = realpath($_SERVER["DOCUMENT_ROOT"]);
 require $root.'\\src\\server\\validate.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
    header('Location: \\src\\client\\index.html');
else{

    function generateRandomSalt() {
        return base64_encode(random_bytes(12))  ;
    }

    function validateUser ($username, $password) {
        $sql = "SELECT password FROM Users WHERE Username='$username'";
        $result = mysqli_query($link, $sql); //execute the query
        if($row = mysqli_fetch_assoc($result)){
        
        //username exists, build second query with salt
        $salt = $row['Salt'];
        $saltSql = "SELECT UserID FROM Users WHERE Username='$username'AND Password=MD5('$password$salt')";
        
        $finalResult = mysqli_query($link, $saltSql1);

        if($finalrow = mysqli_fetch_assoc($finalResult)){
        return true; 
        }

        return false; 
        
        }
			$sql = "SELECT username, password FROM users";
            $results = mysqli_query($connection, $sql);

			while ($row = mysqli_fetch_assoc($results)) {
				$uname = $row['username'];
				$pass = $row['password'];

				if($uname == $username && $password == $pass){
                    
					echo "Login Succesfull!";
                    $_SESSION['loggedin'] = true;
                    header('Location: \\src\\client\\index.html');
					break;
				}else
                $no_match_error = "Wrong username or password!";
                echo "<script type='text/javascript'>alert('$no_match_error');</script>";
			} 

    mysqli_free_result($results);
    mysqli_close($connection);
        }
?>
</html>
