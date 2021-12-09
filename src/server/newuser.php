<!DOCTYPE html>

<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Okanagan Bike Trails</title>
<script type="text/javascript" src="./../client/js/main.js"></script>
<script type="text/javascript" src="./../client/validate.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css' rel='stylesheet' />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="./../client/css/main.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
function checkPasswordMatch(e) {
    var password = $("#password").val();
    var confirmPassword = $("#password-check").val();
    if (password != confirmPassword){
      e.preventDefault();
      alert("Passwords do not match.");
      // Why aren't these working? Onload function but they should be loaded on submit!?

      makeRed($("#password"));
      makeRed($("#password-check"));

    } 
  };
</script>
</head>

<body>
<?php include './../client/header.php';?>


<form method="post" action="processnewuser.php" id="mainForm" enctype="multipart/form-data">
  First Name:<br>
  <input type="text" name="firstname" id="firstname" class="required">
  <br>
  Last Name:<br>
  <input type="text" name="lastname" id="lastname" class="required">
  <br>
  Username:<br>
  <input type="text" name="username" id="username" class="required">
  <br>
  email:<br>
  <input type="text" name="email" id="email" class="required">
  <br>
  Password:<br>
  <input type="password" name="password" id="password" class="required">
  <br>
  Re-enter Password:<br>
  <input type="password" name="password-check" id="password-check" class="required">
  <br>
  <input type='file' name='userImage' id='userImage' class='required'/>
  <br><br>
  <input type="submit" value="Create New User" onsubmit="checkPasswordMatch()">
</form>

<?php include './../client/footer.php';?>
</body>
</html>