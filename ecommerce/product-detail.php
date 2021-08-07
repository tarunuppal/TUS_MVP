<?php require_once("class/controller.php");
$obj = new Controller();

$data = array();
if (isset($_GET['Id']) && $_GET['Id'] != '') {
	$data = $obj->SingleProduct($_GET['Id']);
}

if (isset($_POST['AddToCart'])) {
	if ($_POST['Product_Id'] != "" && $_POST['Qty'] != "") {
		$obj->AddOrderItem($_SESSION['Customer_Id'], $_POST['Product_Id'], $_POST['Qty']);
		header("Location:cart.php");
	}
}
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo COMPANY_NAME; ?></title>
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" media="all">
	<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" media="all">
	<link type="text/css" rel="stylesheet" href="css/style.css?v=<?php echo date("His"); ?>" media="all">
</head>

<body>
	<?php include("i.header.php"); ?>

	<section>
		<div class="container">
			<div class="row">

				<div class="col-md-9">
					<div class="row">
						<div class="col-sm-5">
							<img src="<?php echo UPLOADS_URL . $data['Image']; ?>" alt="<?php echo $data['Product_Name'] ?>" class="img-responsive">
						</div>
						<div class="col-sm-7 product-detail">
							<h3><?php echo $data['Product_Name'] ?></h3>
							<div class="price">$<?php echo $data['Product_price'] ?></div>
							<div class="short-desc"><?php echo $data['Product_short_desc'] ?></div>
							<div class="category"><b>Category:</b> <a href="products.php?Category=<?php echo $data['Category_Id'] ?>"><?php echo $data['Category_Name'] ?></a></div>
							<?php if (isset($_SESSION['Customer'])) { ?>
								<form action="" class="form-horizontal" method="post">
									<div class="row">
										<div class="col-sm-6">
											<div class="input-group">
												<input type="hidden" name="Product_Id" value="<?php echo $data['Product_Id'] ?>" />
												<input type="number" name="Qty" class="form-control" min="1" max="99" value="1" />
												<div class="input-group-btn">
													<button type="submit" name="AddToCart" class="btn btn-info"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							<?php } else { ?>
								<div class="space-50"></div>
								<a href="login-register.php" class="btn btn-info"><i class="fa fa-key"></i> Please Login to Buy</a>
							<?php } ?>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 product-description">
							<h2>Description</h2>
							<?php echo html_entity_decode($data['Product_full_desc']); ?>
						</div>
					</div>
				</div>

				<div class="col-md-3 side-panel">
					<h3 class="section-heading">Relative Products</h3>
					<ul>
						<?php
						$RelPro = $obj->GetProducts($data['Category_Id'], "2");
						foreach ($RelPro as $Rel) {
						?>
							<li>
								<a href="product-detail.php?Id=<?php echo $Rel['Product_Id']; ?>">
									<img src="<?php echo UPLOADS_URL . $Rel['Image']; ?>" alt="<?php echo $Rel['Product_Name']; ?>" class="img-responsive">
									<h4><?php echo $Rel['Product_Name']; ?></h4>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>

			</div>
		</div>
	</section>

	<?php include("i.footer.php"); ?>

</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</html>