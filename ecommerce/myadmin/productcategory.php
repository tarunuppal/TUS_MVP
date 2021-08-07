<?php require_once('../class/controller.php');
$obj = new Controller();
$obj->RequireLogin();
$action = (isset($_GET['Action'])) ? $_GET['Action'] : '';

$id = (isset($_GET['Id'])) ? $_GET['Id'] : '';

if ($action == 'update') {
	$_POST = 	$obj->Select("SELECT * FROM product_category where Category_Id=$id");
	$_POST = $_POST[0];
}
if (isset($_REQUEST['UC'])) {

	$result = $obj->Update("UPDATE product_category set Category_Name='" . $obj->ReplaceSql($_REQUEST['Category_Name']) . "', Category_desc='" . $obj->ReplaceSql($_REQUEST['Category_desc']) . "',Category_Publish='" . $obj->ReplaceSql($_REQUEST['Category_Publish']) . "' WHERE Category_Id='" . $obj->ReplaceSql($_REQUEST['Category_Id']) . "'");
	print_r($result);
}

if (isset($_POST['Submit'])) {


	$query = $obj->Insert("INSERT INTO product_category SET Category_Name='" . $obj->ReplaceSql($_POST['Category_Name']) . "',Category_desc='" . $obj->ReplaceSql($_POST['Category_desc']) . "',Category_Publish='" . $obj->ReplaceSql($_POST['Category_Publish']) . "'");
}

if (isset($_REQUEST['del'])) {
	$obj->Update("DELETE FROM product_category WHERE Category_Id='" . $_REQUEST['del'] . "'");
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
				<h3><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp; Product Category</h3>
			</div>
			<div class="col-md-12 container">

				<div class="col-md-4">
					<div class="Box-view">
						<div class="Box-heading">
							<h4>Add New Category</h4>
						</div>
						<div class="Box-body">

							<form class="productcategory-form form-horizontal" action="" method="post">
								<label>Category Name</label>
								<input type="hidden" name="Category_Id" value="<?php echo $id ?>">
								<input type="text" name="Category_Name" class="form-control" value="<?php echo $_POST['Category_Name'] ?>">
								<label>Description</label>
								<input type="text" name="Category_desc" class="form-control" value="<?php echo $_POST['Category_desc'] ?>">
								<label>Publish</label>
								<input type="radio" name="Category_Publish" value="Y" checked>
								Yes
								<input type="radio" name="Category_Publish" value="N">
								No
								<div class="text-center">
									<?php if ($action == 'update') { ?>
										<button type="submit" name="UC" class="btn btn-success">Update</button>
									<?php
									} else { ?>
										<button class="btn btn-success" type="" name="Submit">Submit</button>
									<?php } ?>
									<button class="btn btn-danger" type="" name="reset">Reset</button>
								</div>
							</form>

						</div>
					</div>
				</div>

				<div class="col-md-8">
					<div class="Box-view">
						<div class="Box-heading">
							<h4>Categories list</h4>
						</div>
						<div class="Box-body">

							<table class="table table-striped table-hover category-table" width="100%" border="0" cellspacing="0" cellpadding="0">
								<thead>
									<th>S.no</th>
									<th>Name</th>
									<th>Description</th>
									<th>Action</th>
									<th>Status</th>
								</thead>
								<tbody>
									<?php
									$data = $obj->Select("SELECT * FROM product_category WHERE Category_Publish = 'Y'");
									$i = 1;
									foreach ($data as $row) {
									?>
										<tr>
											<td><?php echo $i++;?>.</td>
											<td><?php echo $row['Category_Name'] ?></td>
											<td><?php echo $row['Category_desc'] ?></td>
											<td><a href="?Action=update&Id=<?php echo $row['Category_Id']; ?>" title="Update"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;<a href="?del=<?php echo $row['Category_Id']; ?>" title="Delete"><i class="fa fa-remove"></i></a></td>
											<td><?php echo $obj->YES_NO[$row['Category_Publish']];?></td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>

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