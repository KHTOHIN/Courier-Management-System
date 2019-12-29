	<?php include ('template/header.php'); ?>
	<title>Courier || Tracking</title>
</head>
<body>
	<?php include('template/nav.php'); 
    $trackID = "";
    if (isset($_GET["trackId"])) {
        $trackID = $_GET["trackId"];
    }
    // query for courier details 
    $statment = $connection->prepare("SELECT * FROM `courier_details` where courier_details_id = :id");
    $get = $statment->execute(array(
        "id" => $trackID
    ));
    $curierDetail = $statment->fetch();

    // query for product 
    $statment = $connection->prepare("SELECT * FROM `product` where product_id = :id");
    $get = $statment->execute(array(
        "id" => $curierDetail["product_id"]
    ));
    $product = $statment->fetch();

    // query for sender 
    $statment = $connection->prepare("SELECT * FROM `sender_reciver` where se_re_id = :id");
    $get = $statment->execute(array(
        "id" => $product["se_id"]
    ));
    $sender = $statment->fetch();

    // query for receiver 
    $statment = $connection->prepare("SELECT * FROM `sender_reciver` where se_re_id = :id");
    $get = $statment->execute(array(
        "id" => $product["re_id"]
    ));
    $receiver = $statment->fetch();

    // query for shipment 
    $statment = $connection->prepare("SELECT * FROM `shipment` where curiour_id = :id");
    $get = $statment->execute(array(
        "id" => $curierDetail["courier_details_id"]
    ));
    $shipment = $statment->fetchAll();
    ?>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="tracking_title">
					<h4> Product Tracking </h4>
				</div>

                    <p class=" t_text">Track your product & see the current condition.</p>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3">
				<form method="get" class="tracking_form">
					<h2>Track your product.</h2>
					<input type="text" class="form-control" name="trackId" placeholder="Enter Your product ID">
					<button type="submit" class="btn btn-default">Get Product Details</button>
				</form>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9">	
			</div>
		</div>
    <?php if (!empty($shipment)): ?>
        <div class="row">
            <div class="col-lg-4">
                <h3>Sender</h3>
                <table class="table">
                    <tr>
                        <td><b>Name: </b></td>
                        <td><?=$sender["name"];?></td>
                    </tr>
                    <tr>
                        <td><b>Email: </b></td>
                        <td><?=$sender["email"];?></td>
                    </tr>
                    <tr>
                        <td><b>Phone: </b></td>
                        <td><?=$sender["phone"];?></td>
                    </tr>
                    <tr>
                        <td><b>Address: </b></td>
                        <td><?=$sender["address"];?></td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4">
                <h3>Product</h3>
                <table class="table">
                    <tr>
                        <td><b>Type: </b></td>
                        <td><?=$product["product_type"];?></td>
                    </tr>
                    <tr>
                        <td><b>Name: </b></td>
                        <td><?=$product["product_name"];?></td>
                    </tr>
                    <tr>
                        <td><b>Weight: </b></td>
                        <td><?=$product["product_weight"];?> kg</td>
                    </tr>
                    <tr>
                        <td><b>Details: </b></td>
                        <td><?=$product["product_details"];?></td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4">
                <h3>Receiver</h3>
                <table class="table">
                    <tr>
                        <td><b>Name: </b></td>
                        <td><?=$receiver["name"];?></td>
                    </tr>
                    <tr>
                        <td><b>Email: </b></td>
                        <td><?=$receiver["email"];?></td>
                    </tr>
                    <tr>
                        <td><b>Phone: </b></td>
                        <td><?=$receiver["phone"];?></td>
                    </tr>
                    <tr>
                        <td><b>Address: </b></td>
                        <td><?=$receiver["address"];?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
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
        </div>
        
    <?php endif ?>
	</div>
	
	
	
	<?php include('template/footer.php') ?>
</body>
</html>