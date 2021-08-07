<?php require_once('../class/controller.php');
$obj = new Controller();
$obj->RequireLogin();
$query = $obj->PerInvoiceOrders($_GET['Id']);
$customer = $query[0];
include('inc.header.php');
?>
<div>
	<?php include('inc.menu.php'); ?>
	<div class="col-md-10 ">
		<?php include('inc.top-header.php');
		?>
		<div class="row content">
			<div class="page-title">
				<h3><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp; Order Detail</h3>
			</div>
			<div class="col-md-12 container">
				<div class="Box-view">
					<div class="Box-body">
						<div class="row" style="padding: 20px;">
							<div class="col-md-12">
								<p>Order No: <?php echo $customer['Order_Id'] ; ?></p>
								<p>Customer Name: <?php echo $customer['User_First_Name'] . ' ' . $customer['User_Last_Name']; ?></p>
								<p>Contact/Email: <?php echo $customer['User_Phone'] . ' / ' . $customer['User_Email']; ?></p>
								<p>Address: <?php echo $customer['User_Address'] . ', ' . $customer['User_City'] . ', ' . $customer['User_State'] . ', ' . $customer['User_Zip']  ; ?></p>
							
								<table class="table table-striped table-hover" width="100%" border="0" cellspacing="0" cellpadding="0">
									<thead>
										<th>S.no</th>
										<th>Image</th>
										<th>Name</th>
										<th>Price</th>
										<th class="text-right">Quantity</th>
										<th class="text-right">Amount</th>
									</thead>
									<tbody>
										<?php
										$i = 1;
										$order_qty = 0;
										$order_amount = 0;
										foreach ($query as $row) {
											$amount = number_format($row['Product_price'] * $row['Quantity'],2);
											$order_qty = $order_qty + $row['Quantity'];
											$order_amount = number_format($order_amount + $amount,2);
										?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><img src="<?php echo UPLOADS_URL . $row['Image']; ?>" class='listIcon' />
													<div class='iconBig'></div>
												</td>
												<td><?php echo $row['Product_Name']; ?></td>
												<td>$<?php echo $row['Product_price']; ?></td>
												<td class="text-right"><?php echo $row['Quantity']; ?></td>
												<td class="text-right"><?php echo "$".$amount; ?></td>
											</tr>
										<?php } ?>
										<tr>
											<td colspan="4" class="text-left"><strong>Total:</strong></td>
											<td class="text-right"><strong><?php echo $order_qty; ?></strong></td>
											<td class="text-right"><strong><?php echo "$".$order_amount; ?></strong></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="clearfix"></div>
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