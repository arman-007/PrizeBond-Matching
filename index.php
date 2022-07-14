<?php

  include ("connection.php");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrizeBond Matcher</title>
    <link rel="stylesheet" href="style.css" />
    <!--adding css file for styling-->
  </head>
  <body>
    <img src="bgimg.jpg" alt="BackGround Image" class="bg" />
    <div class="LoginButtonContainer">
      <button class="LoginButton" onclick="openForm()"><b>Log In</b></button>
    </div>

    <div class="head-container">
      <!--to test popup login options-->
      <div class="loginopt" id="loginopt">
        <form action="login.php">
          <button type="submit" class="havecreate">Have an account?</button>
        </form>
        <form action="create.php">
          <button type="submit" class="havecreate">Create New Account</button>
        </form>
        <button type="button" class="close" onclick="closeForm()">
          <b>Close</b>
        </button>
      </div>

      <script>
        function openForm() {
          document.getElementById("loginopt").style.display = "block";
        }

        function closeForm() {
          document.getElementById("loginopt").style.display = "none";
        }
      </script>

      <!--to test popup login options-->

      <h1>PrizeBond Matcher</h1>

      <p>Match Your PrizeBond in a SECOND!!!</p>
    </div>

    <div class="rulecontainer">
      <div class="rules">
        <ul>
          <li>Search for one prizebond at a time.</li>
          <li>
            Type the number only without serial as "1234567" instead of "X Y
            1234567" in the search box and hit the MATCH button.
          </li>
          <li>Number should be 7-digit long (Ex - 1234567, 7654321).</li>
        </ul>
      </div>
    </div>
    <form action="" method="POST">
      <input
        type="number"
        name="bnum"
        id="bnum"
        placeholder="Enter prizebond number"
        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
        min="1111111"
        maxlength="7"
      />
      <button type="submit" class="MatchButton">MATCH</button>
    </form>
<?php

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

      $randombond = $_POST['bnum'];
      $result = 0;

      if (!empty($randombond))
      {
        //read from DB
        $query = "select * from winnerbonds where bondnum = '$randombond' limit 1";

        $result = mysqli_query($con, $query);
      }

      if (empty($randombond))
      {
        echo "<p class='emptyrandom'>Please Enter A Valid PrizeBond Number!!!</p>";
      }

      if ($result && mysqli_num_rows($result) > 0)
      {
        echo "<p class='won'>HURRAH!!! You've won a PRIZEBOND!</p>";
      }
      if ($result && mysqli_num_rows($result) == 0)
      {
        echo "<p class='emptyrandom'>Sorry! Better luck next time :(</p>";
      }
    }
?>

    <style>
      .emptyrandom {
        color: red;
        text-align: center;
        font-size: 20px;
      }

      .won {
        color: green;
        text-align: center;
        font-size: 20px;
      }
    </style>
  </body>
</html>
