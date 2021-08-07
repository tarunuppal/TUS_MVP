<?php require_once('../class/controller.php');
$obj=new Controller();
if(isset($_GET['logout'])){
	 $obj->Logout();
}
?>
<div class="col-md-2" style="background-color:#3d405b;">
  <div class="row">
    <div class="welcome">
      <h4><i class="fa fa-user fa-fw"></i>&nbsp;&nbsp; Welcome</h4>
    </div>
    <div class="menu">
      <nav>
        <ul class="nav navbar-inverse">
          <li><a href="dashboard.php"><i class="fa fa-home"></i>&nbsp;&nbsp; Dashboard</a></li>
          <li><a href="product.php"><i class="fa fa-shopping-bag"></i>&nbsp;&nbsp;  Products</a></li>
          <li><a href="productcategory.php"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp; Product Categories</a></li>
          <li><a href="orders.php"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; Orders</a></li>
          <li><a href="customers.php"><i class="fa fa-users"></i>&nbsp;&nbsp; Customers</a></li>
          <li><a href="feedback.php"><i class="fa fa-comment-o"></i>&nbsp;&nbsp; Feedback</a></li>
          <li><a href="?logout"><i class="fa fa-sign-out"></i>&nbsp;&nbsp; Logout</a></li>
        </ul>
      </nav>
    </div>
  </div>
</div>
