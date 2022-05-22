<?php
    session_start();
    include 'navigation.php';

    $conn= connect();
    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM users_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));
    if(isset($_GET['id'])){
        $product_id= $_GET['id'];
    } elseif($_POST['Submit']){
        $product_id= $_POST['id'];
        $delete="DELETE FROM shooppinginfo WHERE productID='$product_id' and userID='$id' and status='Selected' ";
                if($conn->query($delete)===true)
                {
                    header('Location: products.php');
                }
                else
                {
                    echo '<script type="text/javascript">';
                    echo ' alert("Sorry! Some error occured.")'; 
                    echo '</script>';
                }
        
    }

    $sql= "SELECT * from shooppinginfo WHERE productID='$product_id' and userID='$id' and status='Selected'";
    $res= mysqli_fetch_assoc($conn->query($sql));

    $sql1= "SELECT * from products WHERE id=$product_id limit 1";
    $res1= mysqli_fetch_assoc($conn->query($sql1));

    $img= $res1['image'];

    $sql= "SELECT COUNT(id) as total_products from products";
    $total_product= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(bought) as total_buy from products";
    $total_buy= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(sold) as total_sell from products";
    $total_sell= mysqli_fetch_assoc($conn->query($sql));
?>
<html>
<head>
    <title> Products </title>
    <link rel="stylesheet" type="text/css" href="css/products.css">
</head>
<body>
<div class="row" style="padding-top: 50px;">
    <div class="col-sm-9">
        <div class="row">
            <section style="padding-left: 20px; padding-right: 20px;">
                <div class="col-sm-3">
                    <div class="card card-green">
                        <h3>Total Products </h3>
                        <h2 style="color: #282828; text-align: center;"><?php echo $total_product?$total_product['total_products']: 'No Products available in stock'; ?></h2>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-yellow" >
                        <h3>Products Bought </h3>
                        <h2 style="color: #282828; text-align: center;"><?php echo $total_buy?$total_buy['total_buy']: 'You haven\'t bought anything yet'; ?></h2>
                    </div>
                </div>
                <div class="col-sm-3 " >
                    <div class="card card-blue" >
                        <h3>Products Sold </h3>
                        <h2 style="color: #282828; text-align: center;"><?php echo $total_sell?$total_sell['total_sell']: 'You haven\'t sold anything yet'; ?></h2>
                    </div>
                </div>
                <div class="col-sm-3" >
                    <div class="card card-red" >
                        <h3>Available Stock </h3>
                        <h2 style="color: #282828; text-align: center;"><?php echo $total_buy?$total_buy['total_buy']-$total_sell['total_sell']: 'You haven\'t invested anything yet'; ?></h2>
                    </div>
                </div>
            </section>
        </div>
        <div class="pt-20 pl-20">
            <div class="col-sm-12" style="background-color: #282828; ">
                <div class="text-center">
                    <h2 style="color: red;"> This Selected Product's order will be Deleted!</h2>
                </div>
                <div class="row pt-20" >
                    <div class="col-sm-5 p-20" >
                        <img src="<?php echo $img;?>" class="pull-right" height="300" width="300" style="border-radius: 10px;">
                    </div>

                    <div class="col-sm-7" >
                    <div class="row">
                            <div class="col-sm-6">
                                <label class="pull-right"><h2> Product ID:</h2></label>
                            </div>
                            <div class="col-sm-6">
                                <h2 style="color: whitesmoke;"><?php echo $res['productID']?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="pull-right"><h2> Product Name:</h2></label>
                            </div>
                            <div class="col-sm-6">
                                <h2 style="color: whitesmoke;"><?php echo ucwords($res['productName']);?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="pull-right"><h2>  Quantity:</h2></label>
                            </div>
                            <div class="col-sm-6">
                                <h2 style="color: whitesmoke;"><?php echo $res['quantity']?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="pull-right"><h2> Price:</h2></label>
                            </div>
                            <div class="col-sm-6">
                                <h2 style="color: whitesmoke;"><?php echo $res['price']?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="pull-right"><h2> Status:</h2></label>
                            </div>
                            <div class="col-sm-6">
                                <h2 style="color: whitesmoke;"><?php echo $res['status']?></h2>
                            </div>
                        </div>
                        
                        <form method="POST" action="cancelSelection.php">
                            <input type="hidden" value="<?php echo $res['productID']; ?>" name="id">
                            <div class="row">
                                <div class="text-center">
                                    <input class="btn btn-danger" type="submit" name="Submit" value="Delete">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card  text-center" >
            <h2>About User</h2>
            <div style="height:100px;"><img src="<?php echo $thisUser['avatar']; ?>" height="100px;" width="100px;" class="img-circle" alt="Please Select your avatar"></div>
            <p><h4><?php echo $thisUser['name'];  ?></h4> is working here since <h4><?php echo date('F j, Y', strtotime($thisUser['created_at'])); ?></h4></p>
        </div>
        <div class="card text-center">
            <h2>Owners Info</h2>
            <p>Some text..</p>
        </div>
    </div>
</div>

<?php include('footer.php')?>

</body>
</html>