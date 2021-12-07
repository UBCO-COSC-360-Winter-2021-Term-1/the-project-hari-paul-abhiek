<!DOCTYPE html>
<html>

<?php
 session_start();
 include 'validate.php';

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) 
    header('Location: ./../client/index.php');
else{


    //-----------admin part
    // $password = md5($password);
    $sql2 = "SELECT username, password FROM admin";
    $results2 = mysqli_query($conn, $sql2);

    while ($row2 = mysqli_fetch_assoc($results2)) {
        $uname2 = $row2['username'];
        $pass2 = $row2['password'];
        if($uname2 == $username && $password == $pass2){
            $_SESSION['admin_loggedIn'] = true;
            $_SESSION['username'] = $uname2;
            $_SESSION['password'] = $pass2;
        }
    }

    //--------------
    //$password = md5($password);

    $sql = "SELECT username, password FROM users";
    $results = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($results)) {
        $uname = $row['username'];
        $pass = $row['password'];

        if($uname == $username && $password == $pass){
            
            echo "Login Succesfull!";
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $uname;
            $_SESSION['password'] = $pass;
            header('Location: ./../client/index.php');
            break;
        }
        else{
        echo "<script>alert(\"Wrong username or password entered. Please try again.\")
        window.location.href='./../server/login.php'</script>";
        }
    } 

mysqli_free_result($results);
mysqli_close($conn);
    }
?>
</html>
