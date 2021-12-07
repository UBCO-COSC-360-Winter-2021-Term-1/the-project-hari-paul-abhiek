<?php
include 'db_conn.php';
if($conn->connect_error){
die("Connection failed");
}
else{
session_start();
}


?>
<!DOCTYPE html>
<html>
$(document).ready(function(){
        load_data("viewall");
        function load_data(query)
        {
            $.ajax({
                url:"admin_posts.php",
                method:"POST",
                data:{query:query},
                success:function(data)
                {
                    $('#theposts').html(data);
                }
            });
        }
        $('#category').change(function(){
            var search = $('#category').val();
            if(search != '')
            {
                load_data(search);
            }
            else
            {
                load_data();
            }
        });
    });
    </script>

  </head>

  <body>
    <header>

      <nav class = "nav-bar">
        <ul>
          <li><a href="logout.php">Log Out</a></li>
          <li class="active"><a href="admin_page.php">Admin</a></li>


        </ul>
      </nav>

    </header>
<body>
    <main>
      <div class = "content-body">


      <h1>ADMIN - Posts</h1>

      <div class = "content">
        <div class = "post-container">

          <div class = "search-post">
            
            <label>Category:</label>

            <select id="category">
                <option value="viewall">View All</option>
                <option value="Dogs">Dogs</option>
                <option value="Cats">Cats</option>
                <option value="Fish">Fish</option>
                <option value="Mouse">Mouse</option>
                <option value="Hamster">Hamster</option>
                <option value="Bird">Bird</option>
                <option value="Other">Other</option>

            </select></br>
          </div>
            
            <div id = "theposts" class = "postandcomments">
                <?php include 'admin_posts.php'; ?>
            </div>