<?php require_once('../class/controller.php');
$obj = new Controller();
$obj->RequireLogin();
$query = $obj->Select("Select * FROM customers");
include('inc.header.php');
?>
<div>
	<?php include('inc.menu.php'); ?>
	<div class="col-md-10 ">
		<?php include('inc.top-header.php');
		?>
		<div class="row content">
			<div class="page-title">
				<h3><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp; Customers</h3>
			</div>
			<div class="col-md-12 container">
				<div class="Box-view">
					<div class="Box-heading">
						<h4>Customers List</h4>
					</div>
					<div class="Box-body">
						<table class="table table-striped table-hover" width="100%" border="0" cellspacing="0" cellpadding="0">
							<thead>
								<th>S.no</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone No</th>
								<th>Address</th>
								<th>City</th>
								<th>State</th>
								<th>Zip</th>
							</thead>
							<tbody>
								<?php
								$i = 1;
								foreach ($query as $row) {
								?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo $row['User_First_Name'] . " " . $row['User_Last_Name']; ?></td>
										<td><?php echo $row['User_Email']; ?></td>
										<td><?php echo $row['User_Phone']; ?></td>
										<td><?php echo $row['User_Address']; ?></td>
										<td><?php echo $row['User_City']; ?></td>
										<td><?php echo $row['User_State']; ?></td>
										<td><?php echo $row['User_Zip']; ?></td>
									</tr>
								<?php } ?>
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