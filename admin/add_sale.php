<?php include '../components/connect.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <section class="update-product">
        <h1 class="heading">Sale Form</h1> 
        <form action="" method="post" enctype="multipart/form-data">
            
          <?php  $id = $_GET['sale'];
$select_products = $conn->prepare("SELECT * FROM `products` WHERE product_id='$id'");
      $select_products->execute();
    $slect_pro = $select_products->fetch();
    $pro_name = $slect_pro['name'];
    $old_prise = $slect_pro['price'];
    ?>
            <span><h4>Product Name : </h4></span><span><?= $pro_name; ?></span>
            <br>
            <span><h4>Original Product Price: </h4></span><span>JD<?= $old_prise; ?></span>
            <br>
            <br>
            <span></span>
            <input type="number" name="new_price" required class="box" placeholder="enter discount percentage">
            <div class="flex-btn">
                <input type="submit" name="update" class="btn" value="ADD">
                <a href="sales.php" class="option-btn">Go Gack</a>
            </div>
        </form>
        
</body>
</html>
<?PHP



?>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['new_price'])){
    $id = $_GET['sale'];
$select_products = $conn->prepare("SELECT * FROM `products` WHERE product_id='$id'");
      $select_products->execute();
$slect_pro = $select_products->fetch();
    $old_prise = $slect_pro['price'];
    $precent = $_POST['new_price'] / 100;
    $precent *= $old_prise ;
    $discount_price = $old_prise - $precent;
( $_POST['new_price']*10/100);
    $xx = $conn->prepare("UPDATE products set price_discount='$discount_price', is_sale='1'
                                    WHERE product_id='$id'");
    $xx->execute();
    header('location:product.php');
}