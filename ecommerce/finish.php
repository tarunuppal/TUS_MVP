<?php require_once("class/controller.php");
$obj = new Controller();
if (isset($_GET['ShopMore']) && $_GET['ShopMore'] == "yes") {
	header("Location:products.php");
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
				<div class="col-md-5  col-md-offset-3 text-center">
					<h3>Thank you for shopping with us</h3>
					<a href="?ShopMore=yes" class="btn btn-lg btn-warning"><i class="fa fa-shopping-bag"></i> SHOP MORE</a>
				</div>
			</div>
		</div>
	</section>

	<?php include("i.footer.php"); ?>

</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</html>