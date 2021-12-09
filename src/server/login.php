<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Okanagan Bike Trails</title>
    <script type="text/javascript" src="./../client/js/main.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css' rel='stylesheet' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./../client/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<?php
include "./../client/header.php";
?>
    <div class="container">
            <?php
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
                header("Location: ./../client/index.php");
              }
             if (!isset($_SESSION["loggedIn"])){
                echo "<form method=\"post\" action=\"processlogin.php\" id=\"mainForm\" >";
                echo "Username:<br>";
                echo " <input type=\"text\" name=\"username\" id=\"username\" class=\"required\">";
                echo " <br>";
                echo " Password:<br>";
                echo " <input type=\"password\" name=\"password\" id=\"password\" class=\"required\">";
                echo " <br>";
                echo " <br>";
                echo " <input type=\"submit\" value=\"Login\" class=\"btn btn-primary\">";
                echo " </form>"; 
                echo "<form method=\"post\" action=\"processforgot.php\" id=\"mainForm\" >";
                echo " <br>";
                echo "Email:<br>";
                echo " <input type=\"text\" name=\"email\" id=\"email\" class=\"required\">";
                echo " <br>";
                echo " <br>";
                echo " <input type=\"submit\" value=\"Forgot Password\" class=\"btn btn-primary\">";
                echo " </form>"; 
             }
            // else{
            //     header('Location: ./../client/index.php');
            // exit();}
            ?>
    </div>

    <?php
    include "./../client/footer.php";
?>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</body>
</html>
