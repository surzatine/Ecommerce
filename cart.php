<?php
error_reporting(0);
include("./conn.php");

include("./session.php");
$sess_Username = $_SESSION["username"];


if($session_flag == 0){
    header("location: login.php");
    die();
}


// users
$user_query = $mysql->query("select * from users where username = '$sess_Username';");
while($row = $user_query->fetch_assoc()){
    $user_id = $row["user_id"];
}


$delete_id = $_GET["delete_id"];
$delete_cart = $mysql->prepare("delete from cart where cart_id = ? and user_id = ? ");
$delete_cart->bind_param("ss", $delete_id, $user_id);
$delete_cart->execute();
$delete_cart->store_result();


// product List Data
// $product_list_query = $mysql->query("select * from product where product_id='$get_product_id';");
// while($row = $product_list_query->fetch_assoc()){
//     $product_id = $row["product_id"];
//     $category_name = $row["category_name"];
//     $product_name = $row["product_name"];
//     $product_image = $row["product_image"];
//     $product_details = $row["product_details"];
//     $product_price = $row["product_price"];
// }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart</title>
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
            <li><a href="index.php">Home</a></li>
            <li><a href="answer.php">Question/Answer</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li class="active"><a href="#">Cart</a></li>
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
    <h2>Cart</h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>S/N</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Total</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $i = 0;
                $cart_query = $mysql->query("select * from cart where user_id = '$user_id';");
                while($row = $cart_query->fetch_assoc()){
                    $i+=1;
                    $cart_id = $row["cart_id"];
                    $cart_product_name = $row["product_name"];
                    $cart_product_quantity = $row["product_quantity"];
                    $cart_product_rate = $row["product_rate"];

                    $cart_product_total = $cart_product_quantity * $cart_product_rate; 

                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$cart_product_name</td>";
                    echo "<td>$cart_product_quantity</td>";
                    echo "<td>$cart_product_rate</td>";
                    echo "<td>$cart_product_total</td>";
                    echo "<td><a href='cart.php?delete_id=$cart_id'>Delete</a></td>";
                    echo "</td>";
                }


            ?>
        </tbody>
    </table>
</div>>

</body>
</html>
