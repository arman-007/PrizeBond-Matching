<?php

    session_start();

    include ("connection.php");
    include ("function.php");

    $user_data = check_login($con);

    $username = $user_data['username'];

    $query = "select * FROM userbond where username = '$username'";

    $result = mysqli_query($con, $query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>PROFILE</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <style>
        .userwelcome {
            margin: 0px 0px -40px;
            display: flex;
            padding: 0px 0px 50px;
        }
        .userwelcome h1 {
            float: left;
            font-size: 60px;
            border-bottom: 5px solid black;
            border-radius: 10px;
            padding: 3px;
        }
        .AddBond {
            color: rgb(255, 255, 255);
            background: rgb(19, 0, 10);
            padding: 10px;
            border: 2px solid rgb(255, 255, 255);
            border-radius: 10px;
            outline: none;
            margin: 5px;
            font-size: 18px;
            cursor: pointer;
            opacity: 0.8;
            width: 25%;
        }

        .AddBond:hover {
            opacity: 1;
        }

        .showuserbonds {
            width: 60%;
            margin: 30px auto;
            background-color: rgba(255, 255, 255, 0.4);
            padding: 20px;
            border-radius: 10px;
            border: 2px solid black;
        }

        .showuserbonds td {
            align-items: center;
            font-size: 25px;
        }
    </style>
    <img src="bgimg.jpg" alt="BackGround Image" class="loginbg" />

    <div class="userwelcome">
        <h1>Hello, <?php echo $user_data['username']; ?>!</h1>
    </div>

    <form method="POST" action="">
        <input type="number"
        name="bnum"
        id="bnum"
        placeholder="Enter prizebond number"
        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
        min="1111111"
        maxlength="7" />
        <button type="submit" class="AddBond" name="submit">Add to Save</button>
    </form>
    
    
    <?php
        if(isset($_POST['submit']))
        {
            $userbond = $_POST['bnum'];
            
            if (!empty($userbond))
            {
                $query = "insert into userbond (username, bondnum) values ('$username', '$userbond')";
                
                mysqli_query($con, $query);

            }
        }

    ?>


    <div class="showuserbonds">
        <table align = "center";>
            <tr>
                <th><h1>Your PrizeBonds</h1></th>
            </tr>  
            <?php
                while($rows = mysqli_fetch_assoc($result))
                {
            ?>
                    <tr>
                        <td> <?php echo $rows['bondnum']; ?> </td>
                    </tr>
            <?php
                }
            ?> 
        </table>
        
        <form method="POST" action="">
            <button name="matchyourbonds" class="MatchButton">Match Your PrizeBonds</button>
        </form>
        
       <?php
            if(isset($_POST['matchyourbonds'])){
                $query2 = "select count(*) FROM userbond A LEFT OUTER JOIN winnerbonds B ON A.bondnum=B.bondnum where username ='$username' and B.bondnum is NOT NULL";

                $num = mysqli_query($con, $query2);
                $rows = mysqli_fetch_assoc($num);

                foreach ($rows as $key=>$item){
                    if ($item > 0){
                        echo "<p class='won'>HURRAH!!! You've won a PRIZEBOND!</p>";
                    }
                    else{
                        echo "<p class='emptyrandom'>Sorry! Better luck next time :(</p>";
                    }
                    
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


    </div>
    <form action="logout.php">
        <button name="logout" class="logout">Log Out</button>
    </form>
    <style>
        .logout{
            background-color: red;
            color: white;
            font-size: 20px;
            padding: 15px 20px;
            border: 2px solid black;
            border-radius: 10px;
            cursor: pointer;
            width: 25%;
            opacity: 0.8;
            outline: none;
        }
    </style>
</body>
</html>