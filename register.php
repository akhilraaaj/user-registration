<?php 
  session_start(); 
  include "config.php";
?>
<html>
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
  </head>
  <body>
    <div class="content">
      <div class="container">
        <form action='<?php echo $_SERVER["REQUEST_URI"]; ?>' method='post' id='form'>
          <div class="form-containers">
            <h1 class='heading'>Register (<?php echo date("d/m/Y"); ?>)</h1>
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
            <input type='submit' name='submit' class='btn' value='Register' />
          </div>
          <?php 
          if(isset($_POST["submit"])) {
            $u_name=mysqli_real_escape_string($con,$_POST["user_name"]);
            $u_pass=mysqli_real_escape_string($con,$_POST["user_password"]);

            $check_query = "SELECT * FROM users WHERE name='$u_name'";
            $check_result = mysqli_query($con, $check_query);
      
            if(mysqli_num_rows($check_result) > 0) {
              echo "<div class='msg-danger'>Username already exists! Please choose another username.</div>";
            } else {
              // Username validation
              if(strlen($u_name) < 3) {
                echo "<div class='msg-danger'>Username must be at least 3 characters long.</div>";
              } 
              //Password Validation
              else if(strlen($u_pass) < 5 || !preg_match("/\d/", $u_pass)) {
                echo "<div class='msg-danger'>Password must be at least 5 characters long and include at least one digit.</div>";
              }
              else {
                $insert_query = "INSERT INTO users (name, password) VALUES ('$u_name', '$u_pass')";
                if(mysqli_query($con, $insert_query)) { 
                  echo "<div class='msg-success'>Registration successful! You can now <a href='login.php' class='hyper-link'>login</a>.</div>";
                } else {
                  echo "<div class='msg-danger'>Error: " . mysqli_error($con) . "</div>";
                }
              }
            }
          }
        ?>
          <?php echo "<div class='register-text'>Already Registered? <a href='login.php' class='hyper-link'>Log in</a>.</div>";?>
        </form>
      </div>
    </div>
  </body>
</html>
