<?php require_once("class/controller.php");
$obj = new Controller();

$obj->RequiredUserLogin();

if(isset($_GET['Action']) && $_GET['Action']=='del') {
	if(isset($_GET['Id']) && $_GET['Id']!='') {
		$obj->DeleteCartItem($_GET['Id']);
		header("Location:cart.php");
	}
}

if( isset($_GET['ShopMore']) && $_GET['ShopMore']=="yes" ){
	header("Location:products.php");
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo COMPANY_NAME;?></title>
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" media="all">
<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" media="all">
<link type="text/css" rel="stylesheet" href="css/style.css?v=<?php echo date("His");?>" media="all">
</head>
<body>
	<?php include("i.header.php");?>
  
  <section>
  	<div class="container">
    	<div class="row">
        <div class="col-md-12">
        	<div class="pull-right"><a href="?ShopMore=yes" class="btn btn-lg btn-warning"><i class="fa fa-shopping-bag"></i> CONTINUE SHOPPING</a> </div>
          <h2 class="section-heading">My Cart</h2>
          <table class="table table-responsive table-cart"  >
          	<thead>
          		<tr>
          			<th width="5%">Sr.</th>
          			<th width="10%" class="text-center">Image</th>
          			<th width="50%">Product</th>
          			<th width="10%" class="text-right">Price</th>
          			<th width="10%" class="text-center">Qty.</th>
          			<th width="10%" class="text-right">Amount</th>
          			<th width="5%" class="text-center"> </th>
          		</tr>
          	</thead>
            <tbody>
              <?php
              $cart = $obj->MyCart($_SESSION['Customer_Id']);
							$CartAmount = 0;
							if($cart){
								$i = 1;
								foreach($cart as $row){
									$Amount = number_format($row['Product_price']*$row['Quantity'],2);
									$CartAmount = number_format($CartAmount+$Amount,2);
								?>
                <tr>
                  <td><?php echo $i++;?>.</td>
                  <td><img src="<?php echo UPLOADS_URL.$row['Image'];?>" alt="<?php echo $row['Product_Name'];?>" class="img-responsive"/></td>
                  <td><b><?php echo $row['Product_Name'];?></b></td>
                  <td class="text-right">$<?php echo $row['Product_price'];?></td>
                  <td class="text-center"><?php echo $row['Quantity'];?></td>
                  <td class="text-right">$<?php echo $Amount;?></td>
                  <td class="text-center"><a href="?Action=del&Id=<?php echo $row['OI_Id'];?>"><i class="fa fa-times fa-lg text-danger"></i></a></td>
                </tr>
                <?php	
								}
							}
							?>
            </tbody>
          </table>
        	
          <div class="space-50"></div>
          
          <div class="col-md-12">
            <table class="table table-responsive table-cart">
              <tbody>
                <tr>
                  <th class="text-right" width="80%"><b>TOTAL:</b></th>
                  <th class="text-right" width="20%"><h3>$<?php echo number_format($CartAmount,2);?></h3></th>
                </tr>
                <tr>
                	<td colspan="2" class="text-right">
                  	<a href="?ShopMore=yes" class="btn btn-lg btn-warning"><i class="fa fa-shopping-bag"></i> CONTINUE SHOPPING</a>
                  	<a href="checkout.php" class="btn btn-info btn-lg"><i class="fa fa-money "></i> PROCEED TO CHECKOUT</a>
                  </td>
                </tr>		
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </div>
  </section>
  
  <?php include("i.footer.php");?>
  
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>