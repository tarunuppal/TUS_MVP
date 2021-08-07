<?php require_once("class/controller.php");
$obj = new Controller();
$result = $obj->GetCustomerDetail($_SESSION['Customer_Id']);
$Customer_Id = $_SESSION['Customer_Id'];
if(isset($_POST['Place_Order'])){
	$obj->Checkout($_POST);
}

$data123 = $obj->MyCart($_SESSION['Customer_Id']);

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
      	<h2 class="section-heading">Checkout</h2>
        <h3>Billing Address</h3>
        <div class="space-20"></div>
        <form action="" class="form-horizontal" method="post">
        	<div class="col-md-6">
          	<div class="form-group">
              <div class="col-md-6">
                <label for="first_name">First Name *</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $result['User_First_Name']?>" required />
              </div>
              <div class="col-md-6">
                <label for="last_name">Last Name </label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $result['User_Last_Name']?>" required />
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6">
                <label for="email">Email *</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $result['User_Email']?>" required />
              </div>
              <div class="col-md-6">
                <label for="contact_number">Contact Number *</label>
                <input type="text" name="User_Phone" id="contact_number" class="form-control" value="<?php echo $result['User_Phone']?>" required />
              </div>
            </div>
            
          </div>
          <div class="col-md-6">
          	<div class="form-group">
            	<div class="col-md-12">
                <label for="address">Address *</label>
                <textarea name="User_Address" id="address" class="form-control" required style="height:108px"><?php echo $result['User_Address']?></textarea>
              </div>
            </div>
            <div class="form-group">
            	<div class="col-md-12">
                <label for="city">Town/City</label>
                <input type="text" name="User_City" id="city" class="form-control" value="<?php echo $result['User_City']?>" />
              </div>
            </div>
            <div class="form-group">
            	<div class="col-md-6">
                <label for="district">State *</label>
                <input type="text" name="User_State" id="district" class="form-control" value="<?php echo $result['User_State']?>" required />
              </div>
              <div class="col-md-6">
                <label for="zip">Postal/ZIP *</label>
                <input type="text" name="User_Zip" id="zip" class="form-control" value="<?php echo $result['User_Zip']?>" required />
              </div>
            </div>
          </div>
          
          <div class="clear"></div>
          <div class="space-20"></div>
          <hr>
          
          <h3>Your Order</h3>
          <table class="table table-responsive">
          <?php 
					$i=1;
					$total = 0;
					foreach($data123 as $value){
						$total += $value['Product_price'] * $value['Quantity'];
					?>
          	<tr>
          		<td width="5%" class="text-right"><?php echo $i++;?></td>
          		<td width="70%"><?php echo $value['Product_Name'];?></td>
          		<td width="10%" class="text-right">$<?php echo $value['Product_price'];?></td>
          		<td width="5%" class="text-center"><?php echo $value['Quantity'];?></td>
          		<td width="10%" class="text-right">$<?php echo number_format($value['Product_price']*$value['Quantity'],2);?></td>
          	</tr>
            <?php } ?>
          	
            <tr>
            	<td colspan="4" class="text-right"><h3>Total:</h3></td>
              <td class="text-right"><h3>$<?php echo number_format($total,2);?></h3></td>
              <input type="hidden" name="Order_Amount" value="<?php echo $total; ?>" >
							<input type="hidden" name="Customer_Id" value="<?php echo $Customer_Id; ?>" >
            </tr>
          </table>
          
          <div class="clear"></div>
          <div class="space-20"></div>
          <hr>
          
          <h3>Payment Method</h3>
          <div class="col-md-6 col-md-offset-3">
          	<table class="table table-responsive">
            	<tr>
            		<td>
                	<div class="form-group">
                  	<div class="col-sm-1">
                    	<input type="radio" name="pay_method" value="COD" id="cod" />
                    </div>
                  	<label for="cod" class="col-sm-11">Cash on Delivery</label>
                  </div>
                </td>
            	</tr>
            	<tr>
            		<td>
                	<div class="form-group">
                  	<div class="col-sm-1">
                    	<input type="radio" name="pay_method" value="DC" id="dc" />
                    </div>
                  	<label for="dc" class="col-sm-11">Debit Card</label>
                  </div>
                </td>
            	</tr>
            	<tr>
            		<td>
                	<div class="form-group">
                  	<div class="col-sm-1">
                    	<input type="radio" name="pay_method" value="CC" id="cc" />
                    </div>
                  	<label for="cc" class="col-sm-11">Credit Card</label>
                  </div>
                </td>
            	</tr>
            </table>
            
            <div class="space-20"></div>
            
           <button type="submit" name="Place_Order" class="btn btn-info btn-lg"><i class="fa fa-check-circle-o"></i> PLACE ORDER</button>
            
          </div>
          
        </form>
      </div>
    </div>
  </section>
  
  <?php include("i.footer.php");?>
  
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>