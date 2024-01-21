<?php
error_reporting(0);
include("./conn.php");

include("./session.php");
$sess_Username = $_SESSION["username"];


$get_product_id = $_GET["get_product_id"];

// users
$user_query = $mysql->query("select * from users where username = '$sess_Username';");
while($row = $user_query->fetch_assoc()){
    $user_id = $row["user_id"];
}

// product List Data
$product_list_query = $mysql->query("select * from product where product_id='$get_product_id';");
while($row = $product_list_query->fetch_assoc()){
    $product_id = $row["product_id"];
    $category_name = $row["category_name"];
    $product_name = $row["product_name"];
    $product_image = $row["product_image"];
    $product_details = $row["product_details"];
    $product_price = $row["product_price"];
}

if(isset($_POST["addtocart"]) && $_POST["addtocart"] == "Add to Cart"){
    if($session_flag == 1){
    $registerQuery = $mysql->prepare("insert into cart(user_id, product_id, product_name, product_quantity, product_rate)values (?,?,?,?,?);");
    
    $registerQuery->bind_param("sssss",$user_id,$product_id, $product_name, $_POST["quantity"], $product_price);
    
    $registerQuery->execute();

    header("location: cart.php");
    }
    else{
        header("location: login.php");
    }
}

if(isset($_POST["wishlist"]) && $_POST["wishlist"] == "Wishlist"){
    if($session_flag == 1){
    $registerQuery = $mysql->prepare("insert into wishlists(user_id, product_id, product_name, product_rate)values (?,?,?,?);");
    
    $registerQuery->bind_param("ssss",$user_id,$product_id, $product_name, $product_price);
    
    $registerQuery->execute();

    header("location: wishlists.php");
    }
    else{
        header("location: login.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Product</title>
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
        /* .card-group{
            display: flex;
flex-wrap: wrap;
        } */

        
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
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="answer.php">Question/Answer</a></li>
            <li><a href="contact.php">Contact</a></li>
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

<div class="container mt-3">
            
    <div class="card-group d-flex flex-wrap">
    <h2><?php echo $product_name;?></h2>
        <h4 class="card-title"><?php echo $category_name;?></h4>
        <div class="card" style="width:400px">
            <img class="card-img-top" src="./product_image/<?php echo $product_image;?>" alt="Card image" style="width:100%">
            <div class="card-body">
                <p class="card-text"><?php echo $product_details;?></p>
                <h4>Price: <?php echo $product_price;?></h4>
                <form action="" method="post">
                    <input type="number" name="quantity" required>
                    <br><br>
                    <input type="submit" name="addtocart" value="Add to Cart" class="btn btn-primary">
                </form>
                
                <form action="" method="post">
                    <br>
                    
                    <input type="submit" name="wishlist" value="Wishlist" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>

    
</div>

</body>
</html>
