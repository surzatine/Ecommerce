<?php
    include './conn.php';

    

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        echo $username . "<br>";
        echo $password . "<br>";

        if($_POST["check_admin"] == "Admin"){
            $loginQuery = $mysql->prepare("select * from admin where adminname=? and password=? ");
            $loginQuery->bind_param("ss", $username, $password);
            $loginQuery->execute();
            $loginQuery->store_result();

            if($loginQuery->num_rows > 0){
                session_start();
                $_SESSION["username"] = $_POST["username"];
                echo "<script>alert('Admin Success');</script>";
                
                header("Location: ./admin.php");
            }
            
            else{
                echo "<script>alert('wrong Admin and/or password');</script>";
                echo "wrong Admin and/or password";
            }
        }
        else{
            $loginQuery = $mysql->prepare("select * from users where username=? and password=? ");
            $loginQuery->bind_param("ss", $username, $password);
            $loginQuery->execute();
            $loginQuery->store_result();

            if($loginQuery->num_rows > 0){
                session_start();
                $_SESSION["username"] = $_POST["username"];
                echo "<script>alert('Users Success');</script>";
                
                header("Location: ./index.php");
            }

            
            else{
                echo "<script>alert('wrong username and/or password');</script>";
                echo "wrong username and/or password";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>

        html {
            min-height: 100%;/* fill the screen height to allow vertical alignement */
            display: grid; /* display:flex works too since body is the only grid cell */
        }
        body {
            margin: auto;
        }
        input{
            padding: 5px 10px;
        }
        #button{
            width: 100px;
        }
    </style>
</head>
<body class="body">
<form id="form_login" method="post">
    <img src="./weed-logo.jpg" alt="" srcset="" width="200px">

    <p>
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="username" type="text" class="form-control" name="username" placeholder="Username">
    </div>
    </p>

    <p>
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
    </div>
    </p>

    <p>        
    <div class="checkbox">
        <label><input type="checkbox" name="check_admin" value="Admin">Admin</label>
    </div>
    </p>
    
    <p>
        <input id="button" type="submit" class="btn btn-primary" value="Login">
    </p>
    <p>
        <a id="button" class="btn btn-success" href="register.php">Register</a>
    </p>
</form>
</div>
</body>
</html>