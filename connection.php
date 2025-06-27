<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "hms";
    $connect =  mysqli_connect($hostname, $username, $password, $database);

    if(!$connect){
        echo "connection failed!";
    }
?>