<?php

$mysql = mysqli_connect("localhost","root","","charasganja");

    if(mysqli_connect_errno()){
        echo "Failed to connect " . mysqli_connect_errno();
        exit();
    }
?>
