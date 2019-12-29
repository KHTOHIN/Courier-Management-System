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

$msg="";
if (isset($_POST['addbranch'])) {
  $branchname=$_POST['bname'];
  $branchlocation=$_POST['blocation'];
  $branchphone=$_POST['bphone'];
  $branchemail=$_POST['bemail'];


  if(!filter_var($branchemail, FILTER_VALIDATE_EMAIL)) {
        $msg = "Please enter valid email.";
    }

  if ($branchname== ""|| $branchlocation== ""|| $branchphone== ""|| $branchemail== "" ) {
    $msg="fild can't be blank<br>";
    }

  if ($msg=="") {
    $statment = $connection->prepare("INSERT INTO `branch`(`branch_name`, `b_location`, `b_phone`, `b_email`) VALUES (:name, :location, :phn, :email)");
    $done= $statment->execute(array(
      "name"=>$branchname,
      "location"=>$branchlocation,
      "phn"=>$branchphone,
      "email"=>$branchemail
    ));
    if ($done) {
      $msg="add branch succesfully.";
       redirect("branch.php");
    }
  }
  
}
?>



<div class="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">
        <a href="branch.php">Branch</a></li>
    </ol>
     </div>
     <div class="container">
       <div class="row">
        <div class="col-lg-2"></div>
          <div class="branch">
             <form class="branch-add-form" method="post">
                  <h4>Add Branch</h4>
                  <?php echo $msg; ?>
                <div class="form-group">
                  <label>Branch Name:</label>
                  <input type="text" class="form-control" name="bname">
                </div>
                <div class="form-group">
                    <label>Location:</label>
                    <input type="text" class="form-control" name="blocation">
                </div>
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" class="form-control"  name="bphone">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" name="bemail">
                </div>
                <button type="submit" class="btn btn-default" name="addbranch">Add Branch</button>

             </form>
           </div>
       </div>
     </div>

     


  </div>
  <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->
<?php include_once 'partials/footer.php'; ?>