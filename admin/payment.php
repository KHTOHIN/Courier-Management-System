<?php
$headerStyle = array(
  "vendor/datatables/dataTables.bootstrap4.css"
  );
$footerScript = array(
  "vendor/popper/popper.min.js",
  "vendor/jquery-easing/jquery.easing.min.js",
  "vendor/chart.js/Chart.min.js",
  "vendor/datatables/jquery.dataTables.js",
  "vendor/datatables/dataTables.bootstrap4.js"
  );
$siteTitle = "Home"; 
include_once 'partials/header.php'; 

$call = $connection->prepare("SELECT * FROM `payment`");
$call->execute();
$getdbvalue = $call->fetchAll();

if (isset($_GET['paumentid'])) {
    $stm=$connection->prepare("DELETE FROM `payment` WHERE `payment_id` = :paumentid");
    $stm->bindValue("paumentid", (int) $_GET['paumentid']);
    if ($stm->execute()) {
        redirect("read-payment.php");
    }
}

?>



<div class="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">
        <a href="payment.php">Payment</a></li>
        


    </ol>
    <div class="btn btn-default">
                <a href="payment-manage.php">CreateNew</a>
            </div>
    <div class="row">
            <div class="col-lg-6">
                <table class="table">
                  <tr>
                    <th>Payment Type</th>
                    <th>Payment Tax</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($getdbvalue as $tablem ){ ?>
                <tr>
                    <td> <?php echo $tablem["payment_type_name"];?> </td>
                    <td><?php echo $tablem["payment_tax"];?></td>
                    <td>
                        <a href="update-payment.php?paumentid=<?php echo $tablem["payment_id"];?>">Edit</a> | 
                        <a onclick="alert('Are you sure? \nyou want to delete this payment.');" href="read-payment.php?paumentid=<?php echo $tablem["payment_id"];?>">Delate</a>
                    </td>
                </tr>
                <?php } ?>
                </table>
            </div>
    </div>
            
            

    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->
<?php include_once 'partials/footer.php';?>