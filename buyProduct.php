<?php
    session_start();
    include 'navigation.php';

    $conn= connect();
    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM users_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));
    if(isset($_GET['id'])){
        $product_id= $_GET['id'];

        $sql= "SELECT * from products WHERE id=$product_id limit 1";
        $res= mysqli_fetch_assoc($conn->query($sql));

        $img= $res['image'];
    }

    $sql= "SELECT COUNT(id) as total_products from products";
    $total_product= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(bought) as total_buy from products";
    $total_buy= mysqli_fetch_assoc($conn->query($sql));

    $sql= "SELECT SUM(sold) as total_sell from products";
    $total_sell= mysqli_fetch_assoc($conn->query($sql));


?>
<?php
if(isset($_POST['submit']))
{
    $product_name = $res['name'];
    $bought = $res['bought'];
    $sold = $res['sold'];
    $price = $res['price'];
    $available = $bought - $sold;
    $buy = $_POST['buy'];
    $totalsold = $sold + $buy;
    $totalprice = $price * $buy;

    if($available >= $buy)
    {
        $sql1 = "UPDATE products SET sold= '$totalsold' WHERE id = '$product_id'";
        if($conn->query($sql1)===true){
            $insert="INSERT INTO shooppinginfo(userID,productID,productName,quantity,price,status)
                VALUES ('$id','$product_id','$product_name','$buy','$totalprice','Selected')";
                if($conn->query($insert)===true)
                {
                    header('Location: products.php');
                }
                else
                {
                    echo '<script type="text/javascript">';
                    echo ' alert("Sorry! Some error occured.")'; 
                    echo '</script>';
                }
        } else{
            echo '<script type="text/javascript">';
            echo ' alert("Sorry! Some error occured.")'; 
            echo '</script>';
        }
    }else{
        echo '<script type="text/javascript">';
        echo ' alert("Sorry! Products are not available.")'; 
        echo '</script>';
    }
}
?>
<html>
    <head>
        <title> Products </title>
        <link rel="stylesheet" type="text/css" href="css/products.css">

        <script>
            function calculate(val){
    var price = "<?php echo $res['price']; ?>";
    var quantity = document.getElementById('buy').value;
    var total = price * quantity;
    
        document.getElementById('checktext1').innerHTML=total;
        document.getElementById('checktext1').style.color='red';
   
}
        </script>
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
                        <h2 > Product Details</h2>
                    </div>
                    <div class="row pt-20" >
                        <div class="col-sm-5 p-20" >
                            <img src="<?php echo $img; ?>" class="pull-right" height="300" width="300" style="border-radius: 10px;">
                        </div>

                        <div class="col-sm-7" >
                        <form method="POST">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Name:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo ucwords($res['name']) ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Buy Quantity:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['bought'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Sell Quantity:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['sold'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Price:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['price'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-right"><h2> Total Price:</h2></label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 ><small style="font-size:30px;" id="checktext1"></small></h2>
                                </div>
                            </div>

                            <div class="row">
                                        <div class="col-sm-6">
                                            <label class="pull-right"><h2> Product Quantity:</h2></label>
                                        </div>
                                        <div class="col-sm-6 form-input pt-10" >
                                            <input type="text" class="login-input" name="buy" id="buy" onkeyup="calculate(this.value);" placeholder="Buy Quantity">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="text-center">
                                            <input class="btn btn-success" type="submit" name="submit" value="ADD">
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