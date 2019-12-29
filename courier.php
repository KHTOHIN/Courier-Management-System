<?php 

include ('template/header.php');

if (!isset($_SESSION["totalPrice"])) {
    redirect("service.php");
}

$senderID = 0;
$reciverID = 0;
$productID = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["completePayment"])) {
	$paymentID = (int) $_POST["payments"];

    $statment = $connection->prepare("SELECT * FROM `payment` WHERE `payment_id` = :id)");
    $get = $statment->execute(array(
        "id" => $paymentID
    ));
    $payment = $statment->fetch();
    $parcent = $payment["payment_tax"];

    $curierID = trackIdGenarate();
    $connection->beginTransaction();

    $tax = ($_SESSION["totalPrice"] / 100) * $parcent;
    $_SESSION["totalPrice"] += $tax;

    try {
        $statment = $connection->prepare("INSERT INTO `sender_reciver`(`branch_id`, `name`, `email`, `phone`, `address`) VALUES (:bid, :name, :email, :phone, :address)");
        $get = $statment->execute(array(
            "bid" => $_SESSION["fromBranchID"],
            "name" => $_SESSION["sendername"],
            "email" => $_SESSION["senderemail"],
            "phone" => $_SESSION["senderphone"],
            "address" => $_SESSION["senderadd"],
        ));
        $senderID = $connection->lastInsertId();


        $statment = $connection->prepare("INSERT INTO `sender_reciver`(`branch_id`, `name`, `email`, `phone`, `address`) VALUES (:bid, :name, :email, :phone, :address)");
        $get = $statment->execute(array(
            "bid" => $_SESSION["toBranchID"],
            "name" => $_SESSION["receivername"],
            "email" => $_SESSION["receiveremail"],
            "phone" => $_SESSION["receiverphone"],
            "address" => $_SESSION["receiveradd"],
        ));
        $reciverID = $connection->lastInsertId();


        $statment = $connection->prepare("INSERT INTO `product`(`product_type`, `product_name`, `product_weight`, `product_details`, `se_id`, `re_id`) VALUES (:ptype, :pname, :pweight, :pdetails, :sender, :rec)");
        $get = $statment->execute(array(
            "ptype" => $_SESSION["ptype"],
            "pname" => $_SESSION["productName"],
            "pweight" => $_SESSION["weidht"],
            "pdetails" => $_SESSION["pdetails"],
            "sender" => $senderID,
            "rec" => $reciverID
        ));
        $productID = $connection->lastInsertId();


        $statment = $connection->prepare("INSERT INTO `courier_details`(`courier_details_id`, `payment_id`, `product_id`, `date`, `price`) VALUES (:id, :paymentID, :productID, now(), :price)");
        $get = $statment->execute(array(
            "id"        => $curierID,
            "paymentID" => $paymentID,
            "productID" => $productID,
            "price"     => $_SESSION["totalPrice"]
        ));


        $statment = $connection->prepare("INSERT INTO `shipment`(`curiour_id`, `s_date`, `location`) VALUES (:cid, now(), :location)");
        $get = $statment->execute(array(
            "cid"       => $curierID,
            "location" => $_SESSION["senderadd"]
        ));

        if ($connection->commit()) {
            sendMail($_SESSION["senderemail"], $_SESSION["sendername"], "<strong>tracking id: $curierID</strong>");
            unset($_SESSION["fromBranchID"]);
            unset($_SESSION["sendername"]);
            unset($_SESSION["senderemail"]);
            unset($_SESSION["senderphone"]);
            unset($_SESSION["senderadd"]);
            unset($_SESSION["toBranchID"]);
            unset($_SESSION["receivername"]);
            unset($_SESSION["receiveremail"]);
            unset($_SESSION["receiverphone"]);
            unset($_SESSION["receiveradd"]);
            unset($_SESSION["ptype"]);
            unset($_SESSION["productName"]);
            unset($_SESSION["weidht"]);
            unset($_SESSION["pdetails"]);
            unset($_SESSION["totalPrice"]);
            $message = "Curier order successfully complete.";
        }

    } catch (Exception $e) {
        $connection->rollBack();
        $message = "something went wrong. Please try again.";
    }
}

?>
    <title>Courier || Home</title>
</head>
<body>
    <?php include('template/nav.php') ?>
    
<div class="container animated fadeIn">

  <div class="row">
    <p><?=$message;?></p>
    <p><i>Thanks for using our service.</i></p>
    <h3>Your Tracking id: <?=$curierID;?></h3>
    <p>Please check your mail to see more datails</p>
    <p>Do you want to make another coriour ?  <a href="service.php">Click</a></p>
    </div>
</div>

</div>
    
    
    <?php include('template/footer.php') ?>
</body>
</html>