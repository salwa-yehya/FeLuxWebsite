<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
	<!--  If you want to help us go here https://www.bootdey.com/help-us -->
    <title>Invoice - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
$user = $conn->prepare("SELECT * FROM `users` where user_id= $user_id " );
$user->execute();
$select_user= $user->fetch(PDO::FETCH_ASSOC);
// _______________________________
$lastOrder=$_SESSION['last_order'];
$sql="SELECT
order_details.NameProduct,order_details.price,order_details.quantity,
orders.total_price,orders.location,orders.order_time,orders.total_quantity,orders.number,orders.email
FROM order_details INNER JOIN orders
ON order_details.order_id=orders.order_id
WHERE order_details.order_id ='$lastOrder'";
$db=$conn->prepare($sql);
$db->execute();
$data= $db->fetchAll(PDO::FETCH_ASSOC);

// _____________________________________-

   ?>
<div class="col-md-12">   
 <div class="row">
		
        <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
    			<div class="receipt-header">
					<div class="col-xs-6 col-sm-6 col-md-6">
					<a href="shop.php" class="option-btn">continue shopping</a>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 text-right">
						<div class="receipt-right">
							<h5>FELUX</h5>
							<p>+962 796781246 <i class="fa fa-phone"></i></p>
							<p>FELUX@gmail.com <i class="fa fa-envelope-o"></i></p>
							<p>Jordan <i class="fa fa-location-arrow"></i></p>
						</div>
					</div>
				</div>
            </div>
			
			<div class="row">
				<div class="receipt-header receipt-header-mid">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">


							<h5><?= $select_user['name']; ?> </h5>
							<p><b>Mobile :</b> <?= $data[0]['number']; ?></p>
							<p><b>Email :</b> <?= $data[0]['email']; ?></p>
							<p><b>Address :</b> <?= $data[0]['location']; ?></p>
						</div>
					
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="receipt-left">
						</div>
					</div>
				</div>
            </div>
			
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
							<th>Quantity</th>
                            <th>Price </th>
							
                        </tr>
                    </thead>
                    <tbody>
				<?php	foreach ($data as $value) {?>
                        <tr>
                            <td class="col-md-9"><?= $value['NameProduct']; ?></td>
                          
							<td class="col-md-3"><i class="fa fa-inr"></i> <?= $value['quantity']; ?></td>  
							<td class="col-md-3"><i class="fa fa-inr"></i> <?= " JD".$value['price']; ?></td>
                        </tr>
                      
						<?php	}?>
                        <tr>
                           
                            <td class="text-right"><h2><strong>Total Price: </strong></h2></td>
                            <td class="text-left text-danger" colspan="2"><h2><strong><i class="fa fa-inr"></i> JD<?= $value['total_price']; ?></strong></h2></td>
                        </tr>
                    </tbody>
                </table>
            </div>
			
			<div class="row">
				<div class="receipt-header receipt-header-mid receipt-footer">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<p><b>Date :</b><?= $value['order_time']; ?></p>
							<h5 style="color: rgb(140, 140, 140);">Thanks for shopping.!</h5>
						</div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="receipt-left">
						</div>
					</div>
				</div>
            </div>
			
        </div>    
	</div>
</div>
<?php

?>
<style type="text/css">
body{
background:#eee;
margin-top:20px;
}
.text-danger strong {
        	color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #333333;
			border-top: 12px solid #8a6d3b;
			margin-top: 50px;
			margin-bottom: 50px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: open sans;
		}
		.receipt-main p {
			color: #333333;
			font-family: open sans;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #414143 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}	
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 34px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}
		
		#container {
			background-color: #dcdcdc;
		}
</style>

<script type="text/javascript">

</script>
</body>
</html>