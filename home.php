<?php 
  session_start();
  if(!isset($_SESSION["user_id"])) {
    header("location:login.php");
  }
?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
  </head>
  <body>
    <div class="content">
      <div class="container">
        <div class="home-container">
          <span class='home-header'>Welcome, <b class="home-user-name"><?php echo $_SESSION["user_name"]; ?>!</b></span>
          <a href='logout.php' class= "logout-btn">Logout</a>
        </div>
      </div>
    </div>
  </body>
</html>
