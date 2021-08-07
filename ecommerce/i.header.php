<div class="top-bar">
	<div class="container">
  	<div class="row">
    	<div class="col-md-6">
      	<i class="fa fa-phone"></i> (000) 000 0000 | 
        <i class="fa fa-envelope"></i> info@myshop.com
      </div>
      <div class="col-md-6 text-right">
      	<ul class="top-nav">
        	<?php if(isset($_SESSION['Customer'])){?>
          <li><a href="user-profile.php"> Welcome <b><?php echo $_SESSION['Customer_Name'];?></b></a></li>|
      		<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> My Cart <span class="cart-count"><?php echo $obj->CartCount($_SESSION['Customer_Id']);?> Item(s)</span> </a></li>
          <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
          <?php }else{ ?>
					<li><a href="login-register.php"><i class="fa fa-key"></i> Login / Register</a></li>
					<?php }	?>
      		
      	</ul>
      </div>
    </div>
  </div>
</div>
<header>
	<div class="container">
  	<div class="space-20"></div>
  	<div class="row">
      <div class="col-sm-8">
        <div class="logo">
          <a href="index.php"><img src="images/logo.png" alt="Logo" class="img-responsive"> </a>
        </div>
      </div>
      <div class="col-sm-4 text-right">
      	<form action="products.php" class="form-horizontal search" method="post" >
        	<div class="input-group">
          	<input type="text" name="keyword" placeholder="Search" class="form-control">
            <div class="input-group-btn">
            	<button type="submit" class="btn btn-info" style="height: 34px;"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="space-20"></div>
    <div class="row">
    	<nav class="navbar category-menu">
      	<ul class="nav navbar-nav">
        <?php 
				$menu = $obj->getCategory();
				foreach($menu as $value){ ?>
      		<li><a href="products.php?Category=<?php echo $value['Category_Id']; ?>"><?php echo $value['Category_Name']?></a></li>
          <?php } ?>
         	<li><a href="feedback.php"><b>Feedback</b></a></li>   		
      	</ul>
      </nav>
    </div>    
  </div>
</header>
