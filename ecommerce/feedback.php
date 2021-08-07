<?php require_once("class/controller.php");
$obj = new Controller();

if (isset($_POST['Submit'])) {
	$result = $obj->Feedback($_POST);
	$_SESSION['MSG'] = "Feedback Submitted.";
} else {
	unset($_SESSION['MSG']);
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
				<h2 class="section-heading">Feedback</h2>
				<?php
				if(isset($_SESSION['MSG']) && $_SESSION['MSG']!=''){
					echo '<div class="alert alert-success">'.$_SESSION['MSG'].'</div>';
				}
				?>
				<div class="col-md-8">
					<form class="form-horizontal" action="" method="post">
						<div class="form-group">
							<label class="control-label col-sm-3">Name *</label>
							<div class="col-sm-9">
								<input type="text" name="Username" class="form-control" placeholder="Name" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Email Address *</label>
							<div class="col-sm-9">
								<input type="text" name="Email" class="form-control" placeholder="Email Address" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Subject *</label>
							<div class="col-sm-9">
								<input type="text" name="Subject" class="form-control" placeholder="Subject" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Message *</label>
							<div class="col-sm-9">
								<textarea name="Message" class="form-control" placeholder="Message" rows="4" required></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-6">
								<button class="btn btn-info col-sm-4" type="submit" name="Submit">Submit</button>
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