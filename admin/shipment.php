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

$statment = $connection->prepare("SELECT * FROM `courier_details`");
$get = $statment->execute();
$curierDetails = $statment->fetchAll();

?>



<div class="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Shipment</li>
        </ol>

            <div class="row">
                <table class="table">
                    <tr>
                        <th>Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Manage</th>
                        <th>Remove</th>
                    </tr>
                    <?php if (!empty($curierDetails)): ?>
                        <?php foreach ($curierDetails as $cd): 
                            $statment = $connection->prepare("SELECT * FROM `product` WHERE `product_id` = :id");
                            $get = $statment->execute(array(
                                "id" => $cd["product_id"]
                            ));
                            $product = $statment->fetch();

                            $statment = $connection->prepare("SELECT * FROM `sender_reciver` WHERE `se_re_id` = :id");
                            $get = $statment->execute(array(
                                "id" => $product["se_id"]
                            ));
                            $sender = $statment->fetchAll();

                            $statment = $connection->prepare("SELECT * FROM `sender_reciver` WHERE `se_re_id` = :id");
                            $get = $statment->execute(array(
                                "id" => $product["re_id"]
                            ));
                            $receiver = $statment->fetchAll();

                            // query for shipment 
                            $statment = $connection->prepare("SELECT * FROM `shipment` where curiour_id = :id");
                            $get = $statment->execute(array(
                                "id" => $cd["courier_details_id"]
                            ));
                            $shipment = $statment->fetchAll();

                        ?>
                        <tr>
                            <td><?=date('F d, Y', strtotime($cd["date"]));?></td>
                            <td><?=$sender[0]["address"];?></td>
                            <td><?=$receiver[0]["address"];?></td>
                            <td><b><?=$sender[0]["name"];?></b><br><?=$sender[0]["email"];?></td>
                            <td><?=end($shipment)["status"];?></td>
                            <td><a href="manage-shipment.php?curior=<?=$cd["courier_details_id"];?>" class="btn btn-primary">Manage</a></td>
                            <td><a href="shipment.php?curior=<?=$cd["courier_details_id"];?>" class="btn btn-default">Delete</a></td>
                        </tr>
                            
                        <?php endforeach ?>
                    <?php endif ?>
                </table>
            </div> 

        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->
<?php include_once 'partials/footer.php';?>