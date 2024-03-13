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
              $u_name = mysqli_real_escape_string($con, $_POST["user_name"]);
              // Check if the username exists in the database
              $check_username_query = "SELECT id, name FROM users WHERE name='{$u_name}'";
              $check_username_result = $con->query($check_username_query);
              if($check_username_result->num_rows > 0) { // Username exists
                $u_pass = mysqli_real_escape_string($con, $_POST["user_password"]);
                //BINARY to check case-sensitivity for password
                $sql = "SELECT id, name FROM users WHERE name='{$u_name}' AND BINARY password='{$u_pass}'";
                $res = $con->query($sql);
                if($res->num_rows > 0) {  // User Authenticated
                  $row = $res->fetch_assoc();
                  $_SESSION["user_id"] = $row["id"];
                  $_SESSION["user_name"] = $row["name"];
                  header("location:home.php");
                  exit();
                } else {
                  echo "<div class='msg-danger'>Invalid Password!!</div>";
                }
              } else {
                echo "<div class='msg-danger'>Username does not exist!! Please register.</div>";
              }
            }
          ?>
          <?php echo "<div class='login-text'>Don't have an account? <a href='register.php' class='hyper-link'>Register</a>.</div>"; ?>
        </form>
      </div>
    </div>  
  </body>
</html>
