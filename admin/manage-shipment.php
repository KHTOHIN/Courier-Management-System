<?php
$headerStyle = array();
$footerScript = array( );
$siteTitle = "Home"; 
include_once 'partials/header.php'; 

    $trackID = "";
    if (isset($_GET["curior"])) {
        $trackID = $_GET["curior"];
    }
    // query for courier details 
    $statment = $connection->prepare("SELECT * FROM `courier_details` where courier_details_id = :id");
    $get = $statment->execute(array(
        "id" => $trackID
    ));
    $curierDetail = $statment->fetch();

    // query for payments 
    $statment = $connection->prepare("SELECT * FROM `payment` WHERE `payment_id` = :id");
    $get = $statment->execute(array(
        "id" => $curierDetail["payment_id"]
    ));
    $payment = $statment->fetch();

    // query for product 
    $statment = $connection->prepare("SELECT * FROM `product` where product_id = :id");
    $get = $statment->execute(array(
        "id" => $curierDetail["product_id"]
    ));
    $product = $statment->fetch();

    // query for receiver 
    $statment = $connection->prepare("SELECT * FROM `sender_reciver` where se_re_id = :id");
    $get = $statment->execute(array(
        "id" => $product["re_id"]
    ));
    $receiver = $statment->fetch();

    // query for sender 
    $statment = $connection->prepare("SELECT * FROM `branch` where branch_id = :id");
    $get = $statment->execute(array(
        "id" => $receiver["branch_id"]
    ));
    $senderBranch = $statment->fetch();

    // query for sender 
    $statment = $connection->prepare("SELECT * FROM `sender_reciver` where se_re_id = :id");
    $get = $statment->execute(array(
        "id" => $product["se_id"]
    ));
    $sender = $statment->fetch();

    // query for receiver 
    $statment = $connection->prepare("SELECT * FROM `branch` where branch_id = :id");
    $get = $statment->execute(array(
        "id" => $sender["branch_id"]
    ));
    $receiverBranch = $statment->fetch();

    // query for shipment 
    $statment = $connection->prepare("SELECT * FROM `shipment` where curiour_id = :id");
    $get = $statment->execute(array(
        "id" => $curierDetail["courier_details_id"]
    ));
    $shipment = $statment->fetchAll();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["trackInfo"])) {
        $v = new Valitron\Validator($_POST);
        $v->rule('required', ['r_location', 'r_status', 'r_note']);

        $r_location  = inputValid($_POST["r_location"]);
        $r_status   = inputValid($_POST["r_status"]);
        $r_note   = inputValid($_POST["r_note"]);

        if(!$v->validate()) {
            setSessionMessage("r_location", $r_location);
            setSessionMessage("r_status", $r_status);
            setSessionMessage("r_note", $r_note);
            $errors = $v->errors();
        }else{
            $statment = $connection->prepare("INSERT INTO `shipment`(`curiour_id`, `s_date`, `location`, `status`, `note`) VALUES (:cid, now(), :location, :status, :note)");
            $insert = $statment->execute(array(
                "cid" => $curierDetail["courier_details_id"],
                "location" => $r_location,
                "status" => $r_status,
                "note" => $r_note
            ));
            if($insert){
                $mailCId = $curierDetail['courier_details_id'];
                $fullTrackUrl = URL."/ptracking.php?trackId=".$mailCId;

                sendMail($sender["email"], $sender["name"], "
                    <b>your product has been update</b>
                    <br>
                    <p>tracking id: <b>$mailCId</b></p>
                    <ul>
                        <li><b>Location: </b>$r_location</li>
                        <li><b>Status: </b>$r_status</li>
                        <li><b>Note: </b>$r_note</li>
                    </ul>
                    <p>Track detials: <a href='$fullTrackUrl'>click</a>
                    ");

                redirect("manage-shipment.php?curior=".$curierDetail["courier_details_id"]);
            }
        }
    }
?>



<div class="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="shipment.php">Shipment</a></li>
            <li class="breadcrumb-item active">Manage Shipment</li>
        </ol>
            <form action="" method="post">

                <div class="row">
                    <!-- sender left row -->
                    <div class="col-lg-4 ">
                        <h2 class="f_title">Sander</h2>
                        <div class="form-group">
                            <label for="l_branch">Branch:</label>
                            <input disabled type="text" class="form-control" id="l_branch" placeholder="" name="l_branch" value="<?=$senderBranch["branch_name"];?>">
                        </div>
                        <div class="form-group">
                            <label for="l_name">Name:</label>
                            <input disabled type="text" class="form-control" id="l_name" placeholder="" name="l_name" value="<?=$sender["name"];?>">
                        </div>
                        <div class="form-group">
                            <label for="l_email">Email:</label>
                            <input disabled type="email" class="form-control" id="l_email" placeholder="" name="l_email" value="<?=$sender["email"];?>">
                        </div>
                        <div class="form-group">
                            <label for="l_phone">Phone:</label>
                            <input disabled type="text" class="form-control" id="l_phone" placeholder="" name="l_phone" value="<?=$sender["phone"];?>">
                        </div>
                        <div class="form-group">
                            <label for="l_address">Address:</label>
                            <input disabled type="text" class="form-control" id="l_address" placeholder="" name="l_address" value="<?=$sender["address"];?>">
                        </div>
                    </div>
                    <!-- Product Area -->
                    <div class="col-lg-4 ">
                        <h2 class="f_title">Product</h2>
                        <div class="form-group">
                            <label for="l_p_type">Product Type:</label>
                            <input disabled type="text" class="form-control" id="l_p_type" placeholder="" name="l_p_type" value="<?=$product["product_type"];?>">
                        </div>
                        <div class="form-group">
                            <label for="l_p_name">Product Name:</label>
                            <input disabled type="text" class="form-control" id="l_p_name" placeholder="" name="l_p_name" value="<?=$product["product_name"];?>">
                        </div>
                        <div class="form-group">
                            <label for="l_p_weidht">Product Weidht:</label>
                            <input disabled type="text" class="form-control" id="l_p_weidht" placeholder="" name="l_p_weidht" value="<?=$product["product_weight"];?>">
                        </div>
                        <div class="form-group">
                            <label for="l_p_etails">Product Details:</label>
                            <input disabled type="text" class="form-control" id="l_p_etails" placeholder="" name="l_p_etails" value="<?=$product["product_details"];?>">
                        </div>       
                    </div>
                    <!-- sender right row -->
                    <div class="col-lg-4 ">
                        <h2 class="f_title">Receiver</h2>
                        <div class="form-group">
                            <label for="r_branch">Branch:</label>
                            <input disabled type="text" class="form-control" id="r_branch" placeholder="" name="r_branch" value="<?=$receiverBranch["branch_name"];?>">
                        </div>
                        <div class="form-group">
                            <label for="r_name">Name:</label>
                            <input disabled type="text" class="form-control" id="r_name" placeholder="" name="r_name" value="<?=$receiver["name"];?>">
                        </div>
                        <div class="form-group">
                            <label for="r_email">Email:</label>
                            <input disabled type="email" class="form-control" id="r_email" placeholder="" name="r_email" value="<?=$receiver["email"];?>">
                        </div>
                        <div class="form-group">
                            <label for="r_phone">Phone:</label>
                            <input disabled type="text" class="form-control" id="r_phone" placeholder="" name="r_phone" value="<?=$receiver["phone"];?>">
                        </div>
                        <div class="form-group">
                            <label for="r_address">Address:</label>
                            <input disabled type="text" class="form-control" id="r_address" placeholder="" name="r_address" value="<?=$receiver["address"];?>">
                        </div>
                    </div>
                </div>
                <input class="btn btn-primary btn-lg" type="submit" name="updateCurierInfo" value="update Curier Info">
            </form>
                <div class="row">
                    <!-- Track Details area -->
                    <div class="col-lg-8 ">
                        <h3>Tracking info</h3>
                        <table class="table">
                            <tr>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Note</th>
                            </tr>
                            <?php foreach ($shipment as $ship): ?>
                                <tr>
                                    <td><?=date('F d, Y', strtotime($ship["s_date"]));?></td>
                                    <td><?=$ship["location"];?></td>
                                    <td><?=$ship["status"];?></td>
                                    <td><?=$ship["note"];?></td>
                                </tr> 
                            <?php endforeach ?>

                        </table>
                    </div>
                    <div class="col-lg-4">
                        <h3>Order Details</h3>
                        <table class="table">
                            <tr>
                                <td><b>Track id:</b></td>
                                <td><?=$curierDetail["courier_details_id"];?></td>
                            </tr>
                            <tr>
                                <td><b>Order Date:</b></td>
                                <td><?=date('F d, Y', strtotime($curierDetail["date"]));?></td>
                            </tr>
                            <tr>
                                <td><b>Payment method:</b></td>
                                <td><?=$payment["payment_type_name"];?></td>
                            </tr>
                            <tr>
                                <td><b>Total price:</b></td>
                                <td><?=$curierDetail["price"];?> BDT</td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="row">
                    <!-- Track Details area -->
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <h2 class="f_title">Track Details</h2>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="r_location">Location:</label>
                                <input type="text" class="form-control <?php if(isset($errors["r_location"])) echo "error_input"; ?>" id="r_location" placeholder="" name="r_location" value="<?php getSessionMessage("r_location"); ?>">
                                <?php if (isset($errors["r_location"])): ?>
                                    <span class="help-block error_text"><?php echo current($errors["r_location"]); ?></span>
                                <?php endif ?>
                            </div>

                            <div class="form-group">
                                <label for="r_status">Status:</label>
                                <select name="r_status" id="r_status" class="form-control <?php if(isset($errors["r_status"])) echo "error_input"; ?>">
                                    <option value="Awaiting Approval">Awaiting Approval</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Shipment Collected">Shipment Collected</option>
                                    <option value="Waiting for Scan">Waiting for scan</option>
                                    <option value="Ready For Depart">Ready For Depart</option>
                                    <option value="Despatched">Despatched</option>
                                    <option value="Arrived">Arrived</option>
                                    <option value="Cleared">Cleared</option>
                                    <option value="Transit">Transit</option>
                                    <option value="Out For Destination">Out For Destination</option>
                                    <option value="Out For Delivery">Out For Delivery</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Returned">Returned</option>
                                    <option value="Hold">Hold</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="r_note">Note:</label>
                                <textarea class="form-control <?php if(isset($errors["r_note"])) echo "error_input"; ?>" rows="5" id="r_note" name="r_note"> <?php getSessionMessage("r_note"); ?></textarea>
                                <?php if (isset($errors["r_note"])): ?>
                                    <span class="help-block error_text"><?php echo current($errors["r_note"]); ?></span>
                                <?php endif ?>
                            </div>
                            <input class="btn btn-primary btn-lg" type="submit" name="trackInfo" value="update Track Info">
                        </form>  
                    </div>
                </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->
<?php include_once 'partials/footer.php';?>