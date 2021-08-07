<?php require_once('../class/controller.php');
$obj = new Controller();
$obj->RequireLogin();
$query = $obj->GetInvoices();
include('inc.header.php');
?>
<div>
	<?php include('inc.menu.php'); ?>
	<div class="col-md-10 ">
		<?php include('inc.top-header.php');
		?>
		<div class="row content">
			<div class="page-title">
				<h3><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp; Orders</h3>
			</div>
			<div class="col-md-12 container">
				<div class="Box-view">
					<div class="Box-heading">
						<h4>Orders List</h4>
					</div>
					<div class="Box-body">
					<table class="table table-striped table-hover" width="100%" border="0" cellspacing="0" cellpadding="0">
							<thead>
								<th>S.no</th>
								<th>Order Id</th>
								<th>Name</th>
								<th>Order Amount</th>
								<th>Date</th>
								<th>View</th>
							</thead>
							<tbody>
								<?php
								$i = 1;
								foreach ($query as $row) {
								?>
									<tr>
										<td><?php echo $i++; ?>.</td>
										<td><?php echo $row['Order_Id']; ?></td>
										<td><?php echo $row['User_First_Name']; ?></td>
										<td>$<?php echo number_format($row['Order_Amount'], 2); ?></td>
										<td><?php echo $row['Order_Date']; ?></td>
										<td><a href="order_detail.php?Id=<?php echo $row['Order_Id']; ?>">Order Details</a> </td>
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

</html>