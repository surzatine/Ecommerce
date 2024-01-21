<?php
error_reporting(0);
include("./conn.php");

include("./session.php");
$sess_Username = $_SESSION["username"];

$where_query = "";

$get_product = $_GET["get_product"];
if($get_product == null){
    $a = "class='active'";
    $where_query = "";
}
elseif($get_product == "drugs"){
    $b = "class='active'";
    $where_query = "where category_name = 'Drugs'";
}
elseif($get_product == "electronics"){
    $c = "class='active'";
    $where_query = "where category_name = 'Electronics'";
}
elseif($get_product == "rentahacker"){
    $d = "class='active'";
    $where_query = "where category_name = 'Rent A Hacker'";
}
elseif($get_product == "hireahitman"){
    $e = "class='active'";
    $where_query = "where category_name = 'Hire A Hitman'";
}
elseif($get_product == "organs"){
    $f = "class='active'";
    $where_query = "where category_name = 'Organs'";
}
else{

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CharasGanja</title>
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
<h3>Products</h3>
  <ul class="nav nav-tabs">
    <li <?php echo $a; ?>><a href="index.php">All</a></li>
    <li <?php echo $b; ?>><a href="index.php?get_product=drugs">Drugs</a></li>
    <li <?php echo $c; ?>><a href="index.php?get_product=electronics">Electronics</a></li>
    <li <?php echo $d; ?>><a href="index.php?get_product=rentahacker">Rent A Hacker</a></li>
    <li <?php echo $e; ?>><a href="index.php?get_product=hireahitman">Hire A Hitman</a></li>
    <li <?php echo $f; ?>><a href="index.php?get_product=organs">Organs</a></li>
  </ul>
</div>

<div class="container mt-3">
    <?php
        // product List Data
        $product_list_query = $mysql->query("select * from product $where_query order by product_id desc;");
        while($row = $product_list_query->fetch_assoc()){
            $product_id = $row["product_id"];
            $category_name = $row["category_name"];
            $product_name = $row["product_name"];
            $product_image = $row["product_image"];
            $product_details = $row["product_details"];
            $product_price = $row["product_price"];

    ?>
            
            <div class="card-group d-flex flex-wrap">
            <h2><?php echo $product_name;?></h2>
                <h4 class="card-title"><?php echo $category_name;?></h4>
                <div class="card" style="width:400px">
                    <img class="card-img-top" src="./product_image/<?php echo $product_image;?>" alt="Card image" style="width:100%">
                    <div class="card-body">
                        <p class="card-text"><?php echo $product_details;?></p>
                        <h4>Price: <?php echo $product_price;?></h4>
                        <a href="product.php?get_product_id=<?php echo $product_id;?>" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            <!-- <br> -->

    <?php
        }
    ?>

    
</div>

</body>
</html>
