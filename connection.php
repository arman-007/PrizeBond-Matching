<?php
    //connection to DB
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "prizebond";

    if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
    {
        die("failed to connect");
    }

?>