<?php
$conn = new mysqli('cosc360.ok.ubc.ca','webuser','P@ssw0rd','project');
if($conn->connect_error){
   die("Connection failed");
 }else{
    session_start();
}

$sql = "SELECT username, firstName, lastName, email FROM users";
$res = mysqli_query($conn,$sql);
$users = "";

if(mysqli_num_rows($res) > 0) {
  while($row = mysqli_fetch_assoc($res)){
    
    $username = $row['username'];
    $firstname = $row['firstName'];
    $lastname = $row['lastName'];
    $email = $row['email'];
    
    $users.= "<tr>
                <td>".$username."</td>
                <td>".$firstname."</td>
                <td>".$lastname."</td>
                <td>".$email."</td>
                <td> <form name = 'delete-form' action = 'delete_users.php' method = 'post'>
                        <input type = 'hidden' name = 'uname' value = '".$username."'>
                        <button type = 'submit' name = 'del-btn' class = 'delete-btn btn'>delete</button>
                     </form>
                </td>
              </tr>";
    
  }
  
  echo $users;
}

mysqli_close($conn);

?>
