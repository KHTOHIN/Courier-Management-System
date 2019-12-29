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

$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['paumentid'])) {
    $_SESSION['paumentid'] = $_GET['paumentid'];
}
if (!isset($_SESSION['paumentid'])) {
    redirect("read-payment.php");
}

$statment = $connection->prepare("SELECT * FROM `payment` WHERE `payment_id` = :id");
$get = $statment->execute(array(
    "id" => $_SESSION['paumentid']
));
$payment = $statment->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addpayment"])) {
    $v = new Valitron\Validator($_POST);
 $v->rule('required', ['ptname', 'ptax']);


 $ptname = inputValid($_POST['ptname']);
 $ptax = inputValid($_POST['ptax']);

 if (!$v->validate()) {
     $errors = $v->errors();
 }else{
    $statment = $connection->prepare("
            UPDATE `payment` 
            SET 
            `payment_type_name` = :bn, 
            `payment_tax` = :pt
            WHERE 
            `payment_id` = :id"
        );

        $update = $statment->execute(array(
            "id" => $_SESSION['paumentid'],
            "bn" => $ptname,
            "pt" => $ptax
        ));
        if ($update) {
            unset($_SESSION['paumentid']);
            redirect("read-payment.php");
        }
    }   
}
?>



<div class="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">
        <a href="">Update-Payment</a></li>


    </ol>
    <div class="row">
            <div class="col-lg-6">
              <form class="branch-add-form" method="post">
                <h4>Payment</h4>
                <div class="form-group">
                  <label>Payment Type Name:</label>
                  <input type="text" class="form-control" name="ptname" value="<?php echo $payment["payment_type_name"]; ?>">
                </div>
                <div class="form-group">
                    <label>Payment Tax:</label>
                    <input type="text" class="form-control" name="ptax" value="<?php echo $payment["payment_tax"]; ?>">
                </div>
                <button type="submit" class="btn btn-default" name="addpayment">Update Payment</button>

             </form>
            </div>
    </div>
            
            

    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->
<?php include_once 'partials/footer.php';?>