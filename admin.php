<?php
    include("./session.php");
    include("./conn.php");

    $sess_Username = $_SESSION["username"];
    // echo "<script>alert('$sess_Username');</script>";
    $loginQuery = $mysql->prepare("select * from admin where adminname=?  ");
    $loginQuery->bind_param("s", $sess_Username);
    $loginQuery->execute();
    $loginQuery->store_result();

    // Dublicate Data
    $dublicate_query = $mysql->query("select * from admin where adminname='$sess_Username';");
    while($row = $dublicate_query->fetch_assoc()){
        $sess_admin_id = $row["admin_id"];
    }

    $session_admin_flag = 0;
    if($loginQuery->num_rows > 0){
        $session_admin_flag = 1;
    }
    
    else{
        header("location: login.php");
    }


    // Cagegory
    if(isset($_POST["upload_category"]) && $_POST["upload_category"] == "Create"){

        $registerQuery = $mysql->prepare("insert into category(admin_id, category_name)values (?,?);");
    
        $registerQuery->bind_param("ss",$sess_admin_id,$_POST["category_name"]);
        
        $registerQuery->execute();

    }
    
    
    // prdouct
    if(isset($_POST["upload_product"]) && $_POST["upload_product"] == "Upload"){
        
        // category_id
        $category_name = $_POST['category_name'];
        $dublicate_query = $mysql->query("select * from category where category_name='$category_name';");
        while($row = $dublicate_query->fetch_assoc()){
            $category_id = $row["category_id"];
        }
        $product_image_upload_flag = 0;

        $product_details = $_POST['product_details'];
        // echo "<script>alert('$product_details');</script>";
        
        if (isset($_FILES['product_image']['error']) && $_FILES['product_image']['error']== 0 ) {
            // echo "<script>alert('Test 1');</script>";
            if (isset($_FILES['product_image']['size']) && $_FILES['product_image']['size'] < 4000000) {
                $file_types = ['image/jpeg','image/png','image/jpg'];
                if (in_array($_FILES['product_image']['type'], $file_types)) {
                    //chmod('images', 0777);
                    
            // echo "<script>alert('Test 2');</script>";
                    echo  $pname = uniqid() . '_' . $_FILES['product_image']['name'];
                    if (move_uploaded_file($_FILES['product_image']['tmp_name'], 'product_image/' .$pname )) {
                        // echo 'Success';
                        $product_image_upload_flag = 1;
                    } 
                    else {
                        $err['profile'] = 'Image upload failed';
                    }
                } 
                else {
                    $err['profile'] = 'Image type mismatch';
                }
            } 
            else {
                $err['profile'] = 'Image size exceed';
            }
        } 
        else {
            $err['profile'] = 'Please upload image';
        }
        
        if($product_image_upload_flag == 1){
            $registerQuery = $mysql->prepare("insert into product(admin_id, category_id, category_name, product_name, product_image, product_details, product_price)values (?,?,?,?,?,?,?);");
    
            $registerQuery->bind_param("sssssss",$sess_admin_id,$category_id,$_POST["category_name"],$_POST["product_name"], $pname, $_POST["product_details"], $_POST["price"]);
            
            $registerQuery->execute();

        }
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        #img_logo{
            margin-bottom: 10px;
        }
        #img_logo img{            
            border-radius: 100%;
        }
        

        input[type=file]::file-selector-button {
            margin-right: 20px;
            border: none;
            background: #0dcaf0;
            padding: 10px 20px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        input[type=file]::file-selector-button:hover {
            background: #0d45a5;
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
        <li class="active"><h3><a href="#">Welcome, <?php echo $sess_Username; ?></a></h3></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="./logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2>Product Upload</h2>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">




    <div class="form-group">
        <label class="control-label col-sm-2" for="image">Product Image:</label>
        <div class="col-sm-10">
            <div class="form-control">
                <input type="file" name="product_image">
            </div>
        </div>
    </div>




    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Product Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="product_name" placeholder="Enter Name" name="product_name">
        </div>
    </div>

    
    <div class="form-group">        
        <label for="sel1" class="control-label col-sm-2">Product Category:</label>
        <div class="col-sm-10">
            <select class="form-control" id="sel1" name="category_name">

                <?php
                    // Options
                    $dublicate_query = $mysql->query("select * from category;");
                    while($row = $dublicate_query->fetch_assoc()){
                        $option_category_name = $row["category_name"];
                        echo "<option value='$option_category_name'>$option_category_name</option>";
                    }
                ?>
                <!-- <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option> -->
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="product_details">Product Details:</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5" id="comment" name="product_details"></textarea>
        </div>
    </div>

    
    <div class="form-group">
        <label class="control-label col-sm-2" for="price">Price:</label>
        <div class="col-sm-10">          
            <input type="text" class="form-control" id="pwd" placeholder="Enter Price" name="price">
        </div>
    </div>


    <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-primary" name="upload_product" value="Upload">
        </div>
    </div>
    </form>


    <br><br><br>
    <h2>Product Category</h2>
    <form class="form-horizontal" method="post">

    <div class="form-group">
        <label class="control-label col-sm-2" for="category">Category Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="category_name" placeholder="Enter Category Name" name="category_name">
        </div>
    </div>

    <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-success" name="upload_category" value="Create">
        </div>
    </div>

    </form>

</div>


</body>
</html>