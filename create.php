<?php

  include ("connection.php");
  include ("function.php");

  if ($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password))
    {
      $query = "insert into userinfo (username, password) values ('$username', '$password')";

      mysqli_query($con, $query);

      header("Location: login.php");
      die;
    }
    else
    {
      echo "Please enter valid information";
    }
  }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>Create Account</title>
    <link rel="stylesheet" href="style.css" >
  </head>
  <body>
    <img src="bgimg.jpg" alt="BackGround Image" class="loginbg" >
    <form method="POST" action="">
    <div class="loginbox">
      <h1>Create Account</h1>


      <div class="logintextbox">
        <i class="fa fa-user" aria-hidden="true"></i>
        <input name= "username" type="text" placeholder="select a unique username" >
      </div>

      <div class="logintextbox">
        <i class="fa fa-lock" aria-hidden="true"></i>
        <input name= "password" type="password" placeholder="chose a password" >
      </div>
      <button type="submit" class="CreateAccountButton" name="submit">Create Your Account</button>
      <a href="login.php">click to Login</a> <br>
      <a href="index.php">HomePage</a>
    </form>
    </div>
  </body>
</html>
