<?php require_once("class/controller.php");
$obj = new Controller();

$id = (isset($_GET['Id'])) ? $_GET['Id'] : '';

if (isset($_POST['Update'])){
    $obj->UpdateUserProfile($_POST);
}

$user = $_SESSION['C_Data'];
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
                <div class="col-md-12">
                    <h2 class="section-heading">My Profile</h2>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <form class="form-horizontal" action="" method="POST">
                                <div class="form-group">
                                    <label class="control-label col-sm-3">First Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="User_First_Name" class="form-control" value="<?php echo $user['User_First_Name'];?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Last Name </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="User_Last_Name" class="form-control" value="<?php echo $user['User_Last_Name'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Address </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="User_Address" class="form-control" value="<?php echo $user['User_Address'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">City </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="User_City" class="form-control" value="<?php echo $user['User_City'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">State </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="User_State" class="form-control" value="<?php echo $user['User_State'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Zip Code </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="User_Zip" class="form-control" value="<?php echo $user['User_Zip'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Phone Number </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="User_Phone" class="form-control" value="<?php echo $user['User_Phone'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Email Address <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="User_Email" class="form-control" value="<?php echo $user['User_Email'];?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Password <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="password" name="User_Password" class="form-control" value="<?php echo $user['User_Password'];?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <button class="btn btn-info col-sm-4" type="submit" name="Update">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("i.footer.php"); ?>

</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</html>