<?php
    $serverhost = "localhost";
    $user="root";
    $password="";
    $database="sanggarliza";

    $connection = new mysqli($serverhost,$user,$password,$database);
    if($connection->connect_error){
        die("Connection failed, please check your server");
    }

?>