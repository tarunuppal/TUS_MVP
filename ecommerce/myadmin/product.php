<?php require_once('../class/controller.php');
$obj = new Controller();
$obj->RequireLogin();
$query = $obj->Select("Select * FROM product");
if (isset($_REQUEST['del'])) {
	$obj->Update("DELETE FROM product WHERE Product_Id='" . $_REQUEST['del'] . "'");
	header("Location:product.php");
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
				<h3><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp; Product</h3>
			</div>
			<div class="col-md-12 container">
				<div class="Box-view">
					<div class="Box-heading">
						<h4>Product List</h4>
					</div>
					<div class="Box-body">
						<table class="table table-striped table-hover" width="100%" border="0" cellspacing="0" cellpadding="0">
							<thead>
								<th>S.no</th>
								<th>Image</th>
								<th>Name</th>
								<th>Price</th>
								<th>Category</th>
								<th>Action</th>
								<th>Publish</th>
							</thead>
							<tbody>
								<?php
								$i = 1;
								foreach ($query as $row) {
								?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><img src="<?php echo UPLOADS_URL . $row['Image']; ?>" class='listIcon' />
											<div class='iconBig'></div>
										</td>
										<td><?php echo $row['Product_Name']; ?></td>
										<td>$<?php echo $row['Product_price']; ?></td>
										<td><?php
											$response = "select Category_Name from product_category WHERE Category_Id = '" . $row['Category_Id'] . "'";
											$data = $obj->SingleSelect($response);
											echo $data['Category_Name'];
											?>
										</td>
										<td><a href="newproduct.php?Action=update&Id=<?php echo $row['Product_Id']; ?>" title="Update"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;<a href="?del=<?php echo $row['Product_Id']; ?>" title="Delete"><i class="fa fa-remove"></i></a></td>
										<td><?php echo $obj->YES_NO[$row['Product_Publish']]; ?></td>
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
<?php
include('inc.footer.php');
?>