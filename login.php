<?php 
  session_start(); 
  include "config.php";
?>
<html>
  <head>
    <title>Login</title>
    <link rel='stylesheet' type='text/css' href='styles.css' >
  </head>   
  <body>
    <form action='<?php echo $_SERVER["REQUEST_URI"]; ?>' method='post' id='form'>
      <table>
        <tr>
          <td colspan='2' class='heading'>Login Form</td>
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
          <td><input type='submit' name='submit' class='btn' value='Login'></td>
        </tr>
      </table>
      <?php 
        if(isset($_POST["submit"])){
          $u_name=mysqli_real_escape_string($con,$_POST["user_name"]);
          $u_pass=mysqli_real_escape_string($con,$_POST["user_password"]);
          $sql="select id,name from users where name='{$u_name}' and password='{$u_pass}'";
          $res=$con->query($sql);
          if($res->num_rows>0){
            $row=$res->fetch_assoc();
            $_SESSION["user_id"]=$row["id"];
            $_SESSION["user_name"]=$row["name"];
            header("location:home.php");
          }else{
            echo "<div class='msg-danger'>Invalid Login!!!</div>";
          }
        }
      ?>
    </form>
    <?php echo "<div>New User? <a href='register.php'>Register</a>.</div>"; ?>
  </body>
</html>