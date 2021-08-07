<?php require_once("class/controller.php");
$obj = new Controller();

if (isset($_POST['Register'])) {
	$result = $obj->UserRegister($_POST);
}

if (isset($_POST['Login'])) {
	$result = $obj->UserLogin($_POST);
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
				<div class="col-md-6">
					<h2 class="section-heading">Login</h2>
					<div class="space-30"></div>
					<form action="" method="post" class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-sm-3">Email *</label>
							<div class="col-sm-9">
								<input placeholder="E-mail" type="text" class="form-control" name="User_Email" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Password *</label>
							<div class="col-sm-9">
								<input placeholder="Password" type="password" class="form-control" name="User_Password" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-6">
								<button class="btn btn-info col-sm-4" type="submit" name="Login" value="Login">Login</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-6">
					<h2 class="section-heading">Register</h2>
					<div class="space-30"></div>
					<form class="form-horizontal" action="#" method="post">
						<div class="form-group">
							<label class="control-label col-sm-3">First Name *</label>
							<div class="col-sm-9">
								<input type="text" name="User_First_Name" class="form-control" placeholder="First Name">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Last Name </label>
							<div class="col-sm-9">
								<input type="text" name="User_Last_Name" class="form-control" placeholder="Last Name">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Email Address *</label>
							<div class="col-sm-9">
								<input type="text" name="User_Email" class="form-control" placeholder="Email Address">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Password *</label>
							<div class="col-sm-9">
								<input type="password" name="User_Password" class="form-control" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-6">
								<button class="btn btn-info col-sm-4" type="submit" name="Register">Register</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<?php include("i.footer.php"); ?>
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</html>