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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addpayment"])){
  $v = new Valitron\Validator($_POST);
  $v->rule('required', ['ptname', 'ptax']);

  $paymentTName  = inputValid($_POST["ptname"]);
  $paymentTax   = inputValid($_POST["ptax"]);

  if(!$v->validate()) {
        setSessionMessage("ptname", $paymentTName);
        setSessionMessage("ptax", $paymentTax);
        $errors = $v->errors();
    }else{
      $statment = $connection->prepare("INSERT INTO `payment`(`payment_type_name`, `payment_tax`) VALUES (:ptname, :paytax)");

       $done= $statment->execute(array(
      "ptname"=>$paymentTName,
      "paytax"=>$paymentTax
    ));


    if ($done) {
      echo "done";
    }

}
} 
?>



<div class="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">
        <a href="">Payment</a></li>


    </ol>
    <div class="row">
            <div class="col-lg-6">
              <form class="branch-add-form" method="post">
                <h4>Payment</h4>
                <div class="form-group">
                  <label>Payment Type Name:</label>
                  <input type="text" class="form-control" name="ptname">
                </div>
                <div class="form-group">
                    <label>Payment Tax:</label>
                    <input type="text" class="form-control" name="ptax">
                </div>
                <button type="submit" class="btn btn-default" name="addpayment">Add Payment</button>

             </form>
            </div>
    </div>
            
            

    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->
<?php include_once 'partials/footer.php';?>