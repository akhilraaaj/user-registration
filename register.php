<?php 
  session_start(); 
  include "config.php";
?>
<html>
<head>
  <title>Register</title>
  <link rel='stylesheet' type='text/css' href='styles.css' >
</head>
<body>
  <form action='<?php echo $_SERVER["REQUEST_URI"]; ?>' method='post' id='form'>
    <table>
      <tr>
        <td colspan='2' class='heading'>Registration Form</td>
      </tr>
      <tr>
        <td><label>User Name</label></td>
        <td><input type='text' name='user_name' class='input' required></td>
      </tr>
      <tr>
        <td><label>Password</label></td>
        <td><input type='password' name='user_password' class='input' required></td>
      </tr>
      <tr>
        <td><input type='submit' name='submit' class='btn' value='Register'></td>
      </tr>
    </table>
  </form>
  <?php echo "<div>Already Registered? <a href='login.php'>Log in</a>.</div>"; ?>
  <?php 
    if(isset($_POST["submit"])){
      $u_name=mysqli_real_escape_string($con,$_POST["user_name"]);
      $u_pass=mysqli_real_escape_string($con,$_POST["user_password"]);
      
      // Check if the username already exists
      $check_query = "SELECT * FROM users WHERE name='$u_name'";
      $check_result = mysqli_query($con, $check_query);
      
      if(mysqli_num_rows($check_result) > 0) {
        echo "<div class='msg-danger'>Username already exists! Please choose another username.</div>";
      } else {
        // Insert new user data into the database
        $insert_query = "INSERT INTO users (name, password) VALUES ('$u_name', '$u_pass')";
        if(mysqli_query($con, $insert_query)) {
          echo "<div class='msg-success'>Registration successful! You can now <a href='login.php'>login</a>.</div>";
        } else {
          echo "<div class='msg-danger'>Error: " . mysqli_error($con) . "</div>";
        }
      }
    }
  ?>
</body>
</html>
