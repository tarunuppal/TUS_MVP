<?php require_once('../class/controller.php');
$obj = new Controller();
$obj->RequireLogin();
$action = (isset($_GET['Action'])) ? $_GET['Action'] : '';
$id = (isset($_GET['Id'])) ? $_GET['Id'] : '';

if ($action == 'update') {
	$_POST = 	$obj->Select("SELECT * FROM product where Product_Id=$id");
	$_POST = $_POST[0];
}
if (isset($_REQUEST['updateProduct'])) {

	$file_name = $obj->UploadFile($_FILES);
	$obj->Update("UPDATE product set Product_Name='" . $obj->ReplaceSql($_REQUEST['Product_Name']) . "',Image = '$file_name' ,Product_short_desc='" . $obj->ReplaceSql($_REQUEST['Product_short_desc']) . "',Product_full_desc='" . $obj->ReplaceSql($_REQUEST['Product_full_desc']) . "',Product_price='" . $obj->ReplaceSql($_REQUEST['Product_price']) . "',Product_Publish='" . $obj->ReplaceSql($_POST['Product_Publish']) . "',Category_Id='" . $obj->ReplaceSql($_REQUEST['Category_Id']) . "' WHERE Product_Id='" . $obj->ReplaceSql($_REQUEST['Product_Id']) . "'");

	header("location:product.php");
}
if (isset($_POST['Submit'])) {

	$file_name = $obj->UploadFile($_FILES);
	$query = $obj->Insert("INSERT INTO product set Product_Name='" . $obj->ReplaceSql($_POST['Product_Name']) . "',Image = '$file_name' ,Product_short_desc='" . $obj->ReplaceSql($_POST['Product_short_desc']) . "',Product_full_desc='" . $obj->ReplaceSql($_POST['Product_full_desc']) . "',Product_price='" . $obj->ReplaceSql($_POST['Product_price']) . "',Category_Id='" . $obj->ReplaceSql($_POST['Category_Id']) . "',Product_Publish='" . $obj->ReplaceSql($_POST['Product_Publish']) . "'");

	if ($query) {
		header("location:product.php");
	}
}
include('inc.header.php');
?>
<div>
	<?php include('inc.menu.php'); ?>
	<div class="col-md-10 ">
		<?php include('inc.top-header.php');
		?>
		<div class="row content">
			<div class="page-title">
				<h3><i class="fa fa-arrow-circle-left"></i> New Product</h3>
			</div>
			<div class="col-md-12 container">
				<div class="Box-view">
					<div class="Box-heading">
						<h4>Add New Product</h4>
					</div>
					<div class="Box-body new-product">

						<form class="form-horizontal product-form" action="" method="post" enctype="multipart/form-data">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-3">Product Name</label>
									<div class="col-md-9">
										<input type="hidden" name="Product_Id" value="<?php echo $id ?>">
										<input type="text" name="Product_Name" class="form-control" value="<?php echo $_POST['Product_Name'];?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3">Short Description</label>
									<div class="col-md-9">
										<input type="text" name="Product_short_desc" class="form-control" value="<?php echo $_POST['Product_short_desc'];?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3">Price</label>
									<div class="col-md-9">
										<input type="text" name="Product_price" class="form-control" value="<?php echo $_POST['Product_price'];?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3">Category</label>
									<div class="col-md-9">
										<select name="Category_Id" class="form-control select" value="">
											<?php
											$query1 = $obj->Select("select Category_Name,Category_Id from product_category WHERE Category_Publish ='Y'");
											foreach ($query1 as $value) {
												$data = $value["Category_Name"];
												$data_id = $value["Category_Id"];
												echo  "<option value='$data_id' ".(($data_id == $_POST['Category_Id'])?"selected":"").">$data</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3">Image</label>
									<div class="col-md-9">
										<?php if ($action == 'new') { ?>
											<input type="file" name="file">
											<?php } else {
											if ($_POST['Image'] != '') { ?>
												<img src="<?php echo UPLOADS_URL.$_POST['Image']; ?>" class="listIcon1" width="100px" />
										<?php	}
											$filename = $_POST['Image'];
											echo $filename;
											echo '<input type="file" name="file">';
										} ?>

									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-md-12">
										<label>Full Description</label>
										<textarea name="Product_full_desc" class="tinymce"><?php echo $_POST['Product_full_desc'];?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3">Publish:</label>
									<div class="col-md-9">
										<input type="radio" name="Product_Publish" value="Y" checked>
										Yes
										<input type="radio" name="Product_Publish" value="N" <?php echo ($_POST["Product_Publish"]=="N")? "checked" : "" ;?>>
										No
									</div>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<?php if ($action == 'update') { ?>
									<button type="submit" name="updateProduct" class="btn btn-success">Update</button>
								<?php
								} else { ?>
									<button class="btn btn-success" type="Submit" name="Submit">Submit</button>
								<?php } ?>
								<button class="btn btn-danger" type="Reset" name="reset">Reset</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php
include('inc.footer.php');
?>