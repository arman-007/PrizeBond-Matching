<?php

  session_start();

  include ("connection.php");
  include ("function.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    //something was posted
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password))
    {
      //read from DB
      $query = "select * from userinfo where username = '$username' limit 1";

      $result = mysqli_query($con, $query);

      if ($result)
      {
        if ($result && mysqli_num_rows($result) > 0)
        {
          $user_data = mysqli_fetch_assoc($result);
          
          if($user_data['password'] === $password)
          {
            $_SESSION['username'] = $user_data['username'];
            header("Location: profile.php");
            die;
          } 
        }    
      }

      echo "WRONG USERNAME OR PASSWORD!!";
    }
    else
    {
      echo "WRONG USERNAME OR PASSWORD!!!";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <img src="bgimg.jpg" alt="BackGround Image" class="loginbg" />
    <form method="POST" action="">
    <div class="loginbox">
      <h1>Login</h1>

      <div class="logintextbox">
        <i class="fa fa-user" aria-hidden="true"></i>
        <input type="text" name="username" placeholder="Username" />
      </div>

      <div class="logintextbox">
        <i class="fa fa-lock" aria-hidden="true"></i>
        <input type="password" name="password" placeholder="Password" />
      </div>
      <button type="submit" class="signinbutton" name="submit">Login</button>
      <a href="create.php">click to SignUp</a> <br>
      <a href="index.php">HomePage</a>
    </form>
    </div>
  </body>
</html>
