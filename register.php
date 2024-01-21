<?php
    include './conn.php';



    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["username"]) && isset($_POST["password"])  && isset($_POST["contact"]) && isset($_POST["email"])){
    
    

        $password = $_POST["password"];
        
        echo "<script> alert ('Test 1') </script>";

        // Dublicate Data
        $dublicate_query = $mysql->query("select * from users;");
        while($row = $dublicate_query->fetch_assoc()){
            $username = $row["username"];
            $contact = $row["contact"];
            $email = $row["email"];
            // $registration = $row["registration"];
            $flag = 0;
            if($_POST["username"] == $username || $_POST["email"] == $email || $_POST["contact"] == $contact ){
                // echo "<script> alert 'duplicate error;' </script>";
                
            echo "<script> alert ('Test 2') </script>";
                $flag += 1;
                // break;
            }
        }

        // if(!preg_match("/(([A-Za-z0-9\_]+))/i", $_POST["username"]) ){
            echo "<script>alert('username is not validate')</script>";
        //     $regex_validate_error = 1;
        // }

        // if(!( strlen($_POST["password"]) < 8 )){
        //     echo "<script>alert('password is not validate')</script>";
        //     $regex_validate_error = 1;
        // }
        
        // if(!preg_match("/(([A-Z][a-z]+)\s)+([A-Z][a-z]+)/i", $_POST["name"]) ){
        //     echo "<script>alert('name is not validate')</script>";
        //     $regex_validate_error = 1;
        // }

        // if(!preg_match("/(([A-Za-z0-9\s]+))/i", $_POST["address"]) ){
        //     echo "<script>alert('address is not validate')</script>";
        //     $regex_validate_error = 1;
        // }


        // if(!preg_match("/98[0-9]{8}/i", $_POST["contact"]) ){
        //     echo "<script>alert('contact is not validate')</script>";
        //     $regex_validate_error = 1;
        // }

        // if(!preg_match("/([a-z|0-9]+@[a-z|0-9]+.[a-z|0-9]+)/i", $_POST["email"]) ){
        //     echo "<script>alert('email is not validate')</script>";
        //     $regex_validate_error = 1;
        // }
        
        if($flag == 0){

            // Register User detail
            $registerQuery = $mysql->prepare("insert into users(username, email, password, contact)values (?,?,?,?);");
        
            $registerQuery->bind_param("ssss",$_POST["username"],$_POST["email"],$_POST["password"],$_POST["contact"]);
            
            $registerQuery->execute();


            header("location: login.php?q=register_success");
        }

        else{
            echo "<script>alert('Dublicate data failed');</script>";
        }
        
    }


    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 
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
        <input type="text" id="username" placeholder="Username" name="username"/>
    </p>
    <p>
        <input type="email" id="email" placeholder="Email" name="email"/>
    </p>
    <p>
        <input type="password" id="password" placeholder="Password" name="password"/>
    </p>
    <p>
        <input type="number" id="contact" placeholder="Contact" name="contact"/>
    </p>
    <p>
        <input id="button" type="submit" class="btn btn-primary" value="Register">
    </p>
    <p>
        <a id="button" class="btn btn-success" href="login.php">Login</a>
    </p>
</form>
</div>
</body>
</html>