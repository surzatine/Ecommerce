<?php

include("./conn.php");

include("./session.php");
$sess_Username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        #img_logo{
            margin-bottom: 10px;
        }
        #img_logo img{            
            border-radius: 100%;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" id="img_logo" href="#">
                <img src="weed-logo.jpg" alt="Logo" style="width:40px;" class="rounded-pill">
            </a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="answer.php">Question/Answer</a></li>
            <li class="active"><a href="contact.php">Contact</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="wishlists.php">Wishlists</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            
        <!-- No Account -->
        <?php
           
           if($session_flag == 0){
               ?>
               
       <li><a href="./register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
       <li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

       <?php
           }
           // Account
           else{
               ?>
               
       <li><a href="./register.php"><span class="glyphicon glyphicon-user"></span>Welcome, <?php echo $sess_Username;?> </a></li>
       <li><a href="./logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
               <?php
           }
       ?>
        </ul>
    </div>
</nav>

<div class="container">
<h3>Contact Us</h3>
<h4>admin@charasganja.onion</h4>

</div>
</body>
</html>