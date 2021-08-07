<?php require_once("class/controller.php");
$obj = new Controller();
if ( isset($_POST['AddToCart']) ) {
	if ( $_POST['Product_Id']!="" && $_POST['Qty']!="" ) {
		$obj->AddOrderItem($_SESSION['Customer_Id'],$_POST['Product_Id'],$_POST['Qty']);
		header("");
	}	
}
?>