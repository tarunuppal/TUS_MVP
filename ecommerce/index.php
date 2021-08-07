<?php require_once("class/controller.php");
$obj = new Controller();
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
  <?php include("i.slider.php");?>
  
  <section>
  	<div class="container">
    	<div class="row">
        <h2 class="section-heading">Top Selling Products</h2>
        <div class="space-10"></div>
        <div class="row">
        	<ul class="product-grid">
        	<?php
					$list1 = $obj->GetRandomProducts("4");
					foreach($list1 as $row1){ ?>
          <li class="col-md-3 product">
          	<a href="product-detail.php?Id=<?php echo $row1['Product_Id']?>" class="thumb" >
            	<img src="<?php echo UPLOADS_URL.$row1['Image'];?>" id="<?php echo $row1['Product_Id']?>" alt="<?php echo $row1['Product_Name']?>" class="img-responsive">
              <h3><?php echo $row1['Product_Name']?></h3>
              <div class="price">$<?php echo $row1['Product_price']?></div>
            </a>
            <a href="product-detail.php?Id=<?php echo $row1['Product_Id']?>" class="btn btn-info">View Details</a>
          </li>
          <?php } ?>
          </ul>
        </div>
      </div>
      <div class="row">
        <h2 class="section-heading">Latest Products</h2>
        <div class="space-10"></div>
        <div class="row product-grid">
        	<?php
					$list1 = $obj->GetRandomProducts("4");
					foreach($list1 as $row1){ ?>
          <div class="col-md-3 product">
          	<a href="product-detail.php?Id=<?php echo $row1['Product_Id']?>" class="thumb" >
	          	<img src="<?php echo UPLOADS_URL.$row1['Image'];?>" id="<?php echo $row1['Product_Id']?>" alt="<?php echo $row1['Product_Name']?>" class="img-responsive">
              <h3><?php echo $row1['Product_Name']?></h3>
              <div class="price">$<?php echo $row1['Product_price']?></div>
            </a>
            <a href="product-detail.php?Id=<?php echo $row1['Product_Id']?>" class="btn btn-info">View Details</a>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>
  
  <?php include("i.footer.php");?>
  
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>