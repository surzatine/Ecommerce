<?php
    session_start();
    
    
    if(!isset($_SESSION["username"])){
        session_destroy();
        $session_flag = 0;
        // header("Location: ./login.php");
        // die();
    }
    else{
        $session_flag = 1;
    }
?>