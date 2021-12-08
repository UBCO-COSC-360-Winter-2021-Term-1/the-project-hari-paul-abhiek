<!DOCTYPE html>
<html>

<?php
 session_start();
 include 'validate.php';

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) 
    header('Location: ./../client/index.php');
else{
        //-----------admin part

        $sql2 = "SELECT username, password FROM admin";
        $results2 = mysqli_query($conn, $sql2);

        while ($row = mysqli_fetch_assoc($results2)) {
            $uname2 = $row['username'];
            $pass2 = $row['password'];
            if($uname2 == $username && $password == $pass2){
                $_SESSION['admin_loggedIn'] = true;
                $_SESSION['username'] = $uname2;
                $_SESSION['password'] = $pass2;
            }
        }

        //--------------
        //$password = md5($password);

        $sql = "SELECT * FROM users";
        $results = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($results)) {
            $uname = $row['username'];
            $pass = $row['password'];
            $pic = $row['pic'];
            $uid = $row['userID'];

            if($uname == $username && $password == $pass){
                
                echo "Login Succesfull!";
                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $uname;
                $_SESSION['password'] = $pass;
                $_SESSION['userID'] = $uid;
                $_SESSION['pic'] = $pic;

                if ($_SESSION['pic'] == 1) {
                    $sql2 = "SELECT destination FROM userimages WHERE userID = $uid";
                    $results2 = mysqli_query($conn, $sql2);
                    $row = mysqli_fetch_assoc($results2);
                    $_SESSION['profileImg'] = $row['destination'];
                }

                header('Location: ./../client/index.php');
                break;
            }
            else{
            echo "<script>alert(\"Wrong username or password entered. Please try again.\")
            window.location.href='./../server/login.php'</script>";
            }
        } 

        mysqli_free_result($results);
        mysqli_free_result($results2);    
        mysqli_close($conn);
    }
?>
</html>
