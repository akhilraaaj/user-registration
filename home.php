<?php 
  session_start();
  if(!isset($_SESSION["user_id"])){
    header("location:login.php");
  }
 ?>
<html>
  <head>
    <title>Welcome</title>
    <link rel='stylesheet' type='text/css' href='styles.css' >
  </head>
  <body>
  <div style='padding:50px;'>
    <p ><a href='logout.php' style='font-size:18px;'>Logout</a></p>
    <div class='msg-success'><b>Welcome </b> : <?php echo $_SESSION["user_name"]; ?></div>
  </div>
  </body>
</html>