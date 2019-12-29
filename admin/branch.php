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

$call = $connection->prepare("SELECT * FROM `branch`");
$call->execute();
$getdbvalue = $call->fetchAll();

if (isset($_GET['branchid'])) {
    $stm=$connection->prepare("DELETE FROM `branch` WHERE `branch_id` = :branchid");
    $stm->bindValue("branchid", (int) $_GET['branchid']);
    if ($stm->execute()) {
        redirect("branch.php");
    }
}

?>



    <div class="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="branch.php">Branch</a>
                </li>
            </ol>
            <div class="btn btn-default">
                <a href="create-branch.php">CreateNew</a>
            </div>
            <div class="message">
                <?php 
                if(isset($_SESSION["branchUpdateMessage"])) {
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php getSessionMessage("branchUpdateMessage"); ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <table class="table">
                <tr>
                    <th>Branch Name</th>
                    <th>Branch Location</th>
                    <th>Branch Phone</th>
                    <th>Branch Email</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($getdbvalue as $tablem ){ ?>
                <tr>
                    <td><?php echo $tablem["branch_name"];?></td>
                    <td><?php echo $tablem["b_location"];?></td>
                    <td><?php echo $tablem["b_phone"];?></td>
                    <td><?php echo $tablem["b_email"];?></td>
                    <td>
                        <a href="update_branch.php?branchid=<?php echo $tablem["branch_id"];?>">Edit</a> | 
                        <a onclick="alert('Are you sure? \nyou want to delete this branch.');" href="branch.php?branchid=<?php echo $tablem["branch_id"];?>">Delate</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->
<?php include_once 'partials/footer.php'; ?>