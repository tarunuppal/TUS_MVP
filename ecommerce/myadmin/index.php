<?php require_once('../class/controller.php');
$obj = new Controller();
if (isset($_POST['submit'])) {
	$user = $obj->CleanData($_POST['username']);
	$pass = $obj->CleanData($_POST['password']);
	$url = ADMIN_URL . "dashboard.php";
	$query = $obj->Login($user, $pass, $url);
}
include('inc.header.php');
?>
<div class="background container-fluid">
	<div class="col-md-4 col-md-offset-4 login-body">
		<form class="form-horizontal login-form" action="" method="post">
			<h4>Welcome, Please Login</h4>
			<div class="form-group">
				<input type="text" class="form-control" name="username" placeholder="Username">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="password" placeholder="Password">
			</div>
			<div class="text-center">
				<Button type="submit" class="btn btn-primary btn-lg" name="submit">Login</Button>
			</div>
		</form>
	</div>
</div>
</body>

</html>