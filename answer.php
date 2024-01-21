<?php

include("./conn.php");

include("./session.php");
$sess_Username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Answer</title>
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
            <li class="active"><a href="answer.php">Question/Answer</a></li>
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
<h3>Cannabis</h3>
<p>We supply high quality hydroponic and organically grown cannabis to customers making every effort to go above and beyond when it comes to customer satisfaction. Our vision is that one day everybody will be able to grow their own medicine, but until then we would like to offer as much assistance to those in need as we possibly can. Our growers have many years of experience flowering, harvesting and curing medical cannabis as well as extracting the oil and producing all the other medicinal products.
</p>

<h3>LSD</h3>
<p>Lysergic acid diethylamide, also known as acid, is a hallucinogenic drug. Effects typically include altered thoughts, feelings, and awareness of one's surroundings. Many users see or hear things that do not exist. Dilated pupils, increased blood pressure, and increased body temperature are typical.
</p>

<h3>Meth</h3>
<p>Methamphetamine is an illegal drug in the same class as cocaine and other powerful street drugs. It has many nicknames—meth, crank, chalk or speed being the most common. Crystal meth is used by individuals of all ages, but is most commonly used as a “club drug,” taken while partying in night clubs or at rave parties. Its most common street names are ice or glass.
</p>

<h3>Shipping</h3>
<p>Your order will be shipped within 24 hours after ordering. Its always vacuum sealed with decoy. Every package is checked twice before shipping. Shipping to the EU is always possible whatever quantity. We don’t ship to the Netherlands.
</p>

<p>We sometimes send parcels using tracking even if the customer has selected ‘regular shipping’. This is to prevent scammers trying to claim an undelivered parcel. We don’t do this with every parcel mind you and we only using the tracking information in case of a dispute.
</p>

<p>Please keep in mind that if you place an order during the weekend it will only be shipped on Monday. Take that into account when calculating the delivery time. Also, during holidays postal services are overwhelmed with parcels and staff shortage so there will always be a delay of a few days in delivery time.
</p>

<p>We might mark the order as shipped even though we might actually send it a day later. This is to prevent LE from trying to identify our delivery pattern.
</p>

<p>Tracking information is available upon request. It’s imporant to remember that we can delay the release of the tracking code if we think it might jeopardize our security protocols or we might not release it at all, only in case of a dispute.
</p>

<p>We cannot ship domestically (NL) using tracking code due to OPSEC protocols. We don’t do face to face or pick-up deliveries either, only through post.
</p>

<p>We advise customers from Germany to use only the Regular Shipping option because with the Tracking code Europe option they might encounter problems with the Hermes Group (stealing parcels, failed deliveries, etc). The Regular Shipping option to Germany has 100% success rate so don’t worry.
</p>

<h3>Shipping format</h3>
<p>When placing your order use the format for addressing that is used in your country. If you are not sure just google how to use a correct format for your country. If you are not sure use the format below. Providing a correct address is your own responsibility please double check it! If it is incorrect you might risk a missing package, without the possibility of any refund.
</p>

<p>Name/Surname</p>

<p>Street/Number</p>

<p>City/Zip Code</p>

<p>Country</p>

<p>Tracking is not available on any listings, due to safety</p>

<p>If your order does not arrive within this estimated times please dont message me but wait for 2 more weeks. There is always a posibility of a delay in the postal services. After this 3 extra weeks please send me a message and I am happy to look into it.
</p>

<h3>Refund policy</h3>
<p>No refunds/reships without any proof of seizure. Providing a correct address is your own responsibilty, we only copy and paste addresses on packages. Refunds for our returning customers will be judged on case by case basis. Generaly a one time 50% reship will be arranged.</p>

<h3>Questions</h3>
<p>Write on e-mail admin@charasganja.onion</p>
</div> 

</body>
</html>