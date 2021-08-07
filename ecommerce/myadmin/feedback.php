<?php require_once('../class/controller.php');
$obj=new Controller();
$obj->RequireLogin();
$query = $obj->Select("Select * FROM feedback");
include('inc.header.php');
?>
<div>
  <?php include('inc.menu.php'); ?>
  <div class="col-md-10 ">
    <?php include('inc.top-header.php');
	 ?>
    <div class="row content">
      <div class="page-title">
        <h3><i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp; Feedback</h3>
      </div>
      <div class="col-md-12 container">
        <div class="Box-view">
          <div class="Box-heading">
            <h4>Feedback</h4>
          </div>
          <div class="Box-body">
            <table class="table table-striped table-hover" width="100%" border="0" cellspacing="0" cellpadding="0" >
              <thead>
                <th>S.no</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
               </thead>
              <tbody>
               <?php
							$i=1; 
							foreach($query as $row){
							?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['Customer_Name']; ?></td>
                  <td><?php echo $row['Customer_Email']; ?></td>
                  <td><?php echo $row['Subject']; ?></td>
                  <td><?php echo $row['Message']; ?></td>
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