<?php 
  session_start(); 
  include "config.php";
?>
<html>
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
  </head>   
  <body>
    <div class="content">
      <div class="container">
        <form action='<?php echo $_SERVER["REQUEST_URI"]; ?>' method='post' id='form'>
          <div class="form-containers">
            <h1 class='heading'>Login (<?php echo date("d/m/Y"); ?>)</h1>
          </div>
          <div class="form-containers">
            <label class="label">User Name</label>
            <input type='text' name='user_name' class='input' required />
          </div>
          <div class="form-containers">
            <label class="label">Password</label>
            <input type='password' name='user_password' class='input' required />
          </div>
          <div class="form-containers">
            <input type='submit' name='submit' class='btn' value='Login' />
          </div>
          <?php 
            if(isset($_POST["submit"])) {
              $u_name=mysqli_real_escape_string($con,$_POST["user_name"]);
              $u_pass=mysqli_real_escape_string($con,$_POST["user_password"]);
              $sql="select id,name from users where name='{$u_name}' and password='{$u_pass}'";
              $res=$con->query($sql);
              if($res->num_rows>0) {
                $row=$res->fetch_assoc();
                $_SESSION["user_id"]=$row["id"];
                $_SESSION["user_name"]=$row["name"];
                header("location:home.php");
              }else {
                echo "<div class='msg-danger'>Invalid Credentials!!</div>";
              }
            }
          ?>
          <?php echo "<div class='login-text'>New User? <a href='register.php' class='hyper-link'>Register</a>.</div>"; ?>
        </form>
      </div>
    </div>  
  </body>
</html>