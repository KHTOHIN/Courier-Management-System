<?php
$headerStyle = array();
$footerScript = array();
$siteTitle = "Update Branch"; 
include_once 'partials/header.php'; 

// storing error message
$errors = array();

// assigning branch id to session
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['branchid'])) {
    $_SESSION['branchid'] = $_GET['branchid'];
}

// cecking branch session have value or not 
// if not it will redirect to branch page
if (!isset($_SESSION['branchid'])) {
    redirect("branch.php");
}

// getting branch value by id
$statment = $connection->prepare("SELECT * FROM `branch` WHERE `branch_id` = :id limit 1");
$get = $statment->execute(array(
    "id" => $_SESSION['branchid']
));
$branch = $statment->fetch();

// checking post method
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $v = new Valitron\Validator($_POST);

    // field empty checking
    $v->rule('required', ['bname', 'blocation', 'bphone', 'bemail']);

    $bname = inputValid($_POST['bname']);
    $blocation = inputValid($_POST['blocation']);
    $bphone = inputValid($_POST['bphone']);
    $bemail = inputValid($_POST['bemail']);

    if(!$v->validate()) {
        setSessionMessage("email", $email);
        $errors = $v->errors();
    } else{
        $statment = $connection->prepare("
            UPDATE `branch` 
            SET 
            `branch_name` = :bn, 
            `b_location` = :bl, 
            `b_phone` = :bp, 
            `b_email` = :be 
            WHERE 
            `branch_id` = :id"
        );

        $update = $statment->execute(array(
            "id" => $_SESSION['branchid'],
            "bn" => $bname,
            "bl" => $blocation,
            "bp" => $bphone,
            "be" => $bemail
        ));

        // branch update success fully then it will redirect branch page
        if ($update) {
            unset($_SESSION['branchid']);
            setSessionMessage("branchUpdateMessage", "Branch Update successfully completed.");
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
                        <h4>Update Branch</h4>
                        <div class="form-group">
                            <label>Branch Name:</label>
                            <input type="text" class="form-control <?php if(isset($errors["bname"])) echo "error_input"; ?>" name="bname" value="<?php echo $branch["branch_name"]; ?>">
                            <?php if (isset($errors["bname"])): ?>
                                <span class="help-block error_text"><?php echo current($errors["bname"]); ?></span>
                            <?php endif ?>                  
                        </div>
                        <div class="form-group">
                            <label>Location:</label>
                            <input type="text" class="form-control <?php if(isset($errors["blocation"])) echo "error_input"; ?>" name="blocation" value="<?php echo $branch["b_location"]; ?>">
                            <?php if (isset($errors["blocation"])): ?>
                                <span class="help-block error_text"><?php echo current($errors["blocation"]); ?></span>
                            <?php endif ?>                    
                        </div>
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" class="form-control <?php if(isset($errors["bphone"])) echo "error_input"; ?>"  name="bphone" value="<?php echo $branch["b_phone"]; ?>">
                            <?php if (isset($errors["bphone"])): ?>
                                <span class="help-block error_text"><?php echo current($errors["bphone"]); ?></span>
                            <?php endif ?>                    
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control <?php if(isset($errors["bemail"])) echo "error_input"; ?>" name="bemail" value="<?php echo $branch["b_email"]; ?>">
                            <?php if (isset($errors["bemail"])): ?>
                                <span class="help-block error_text"><?php echo current($errors["bemail"]); ?></span>
                            <?php endif ?>                    
                        </div>
                        <button type="submit" class="btn btn-default" name="update">Update Branch</button>

                    </form>
                </div>
            </div>
        </div>




    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->
<?php include_once 'partials/footer.php'; ?>