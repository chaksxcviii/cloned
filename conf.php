<?php

    $host ="localhost";
    $user ="cloneadmin";
    $dbname ="cloned";
    $pswd ="75845362@!";
    $psw="";

    $connection = new mysqli($host, $user, $pswd, $dbname);

    if($connection->connect_error){
        echo "Connection Failed".$connection->connect_error;
    }


    ?>