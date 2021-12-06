<!DOCTYPE html>
<html>

<?php
 
 include 'validate.php';

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) 
    header('Location: ./../client/index.php');
else{

    $password = md5($password);

    $sql = "SELECT username, password FROM users";
    $results = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($results)) {
        $uname = $row['username'];
        $pass = $row['password'];

        if($uname == $username && $password == $pass){
            
            echo "Login Succesfull!";
            $_SESSION['loggedin'] = true;
            header('Location: ./../client/index.php');
            break;
        }else
        header('Location: ./../server/login.php');
        echo "alert(\"wrong username or password entered\")";
    } 

mysqli_free_result($results);
mysqli_close($conn);
    }
?>
</html>
