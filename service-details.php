<?php 

include ('template/header.php'); 

$statment = $connection->prepare("SELECT * FROM `branch` where branch_name = :name");
$get = $statment->execute(array(
	"name" => $_SESSION["frombranch"]
));
$formBranchInfo = $statment->fetch();
$formBranchName = $formBranchInfo["b_location"];

$statment = $connection->prepare("SELECT * FROM `branch` where branch_name = :name");
$get = $statment->execute(array(
	"name" => $_SESSION["tobranch"]
));
$toBranchInfo = $statment->fetch();
$toBranchName = $toBranchInfo["b_location"];

$totalPrice = (findDistance($formBranchName, $toBranchName) * 0.5) * $_SESSION["weidht"];


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["confirm"])) {
	if ($_GET['confirm']) {

	$_SESSION["toBranchID"] = (int) $toBranchInfo["branch_id"];
	$_SESSION["fromBranchID"] = (int) $formBranchInfo["branch_id"];
	$_SESSION["totalPrice"] = $totalPrice;
		
	redirect("payment.php");
	}else{
		redirect("service-details.php");
	}
}
?>
	<title>Courier || Service</title>
</head>
<body>
	<?php include('template/nav.php'); ?>


	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<table class="table">
					  <caption>From</caption>
					<tr>
						<td>Branch:</td>
						<td><?php echo ucfirst($_SESSION["frombranch"]); ?></td>
					</tr>
					<tr>
						<td>Name:</td>
						<td><?php echo ucfirst($_SESSION["sendername"]); ?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?php echo ucfirst($_SESSION["senderemail"]); ?></td>
					</tr>
					<tr>
						<td>Phone:</td>
						<td><?php echo ucfirst($_SESSION["senderphone"]); ?></td>
					</tr>
					<tr>
						<td>Address:</td>
						<td><?php echo ucfirst($_SESSION["senderadd"]); ?></td>
					</tr>
				</table>
			</div>
			<div class="col-lg-4">
				<table class="table">
					  <caption>Product</caption>
					<tr>
						<td>Product Type::</td>
						<td><?php echo ucfirst($_SESSION["ptype"]); ?></td>
					</tr>
					<tr>
						<td>Product name::</td>
						<td><?php echo ucfirst($_SESSION["productName"]); ?></td>
					</tr>
					<tr>
						<td>Weidht::</td>
						<td><?php echo ucfirst($_SESSION["weidht"]); ?> kg</td>
					</tr>
					<tr>
						<td>Product Details::</td>
						<td><?php echo ucfirst($_SESSION["pdetails"]); ?></td>
					</tr>
					<tr>
						<td>Total Price::</td>
						<td><?php echo $totalPrice; ?> BDT</td>
                    </tr>
				</table>
			</div>
			<div class="col-lg-4">
				<table class="table">
					  <caption>To</caption>
					<tr>
						<td>Branch:</td>
						<td><?php echo ucfirst($_SESSION["tobranch"]); ?></td>
					</tr>
					<tr>
						<td>Name:</td>
						<td><?php echo ucfirst($_SESSION["receivername"]); ?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?php echo ucfirst($_SESSION["receiveremail"]); ?></td>
					</tr>
					<tr>
						<td>Phone:</td>
						<td><?php echo ucfirst($_SESSION["receiverphone"]); ?></td>
					</tr>
					<tr>
						<td>Address:</td>
						<td><?php echo ucfirst($_SESSION["receiveradd"]); ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-lg-offset-4">
				
				<a href="service.php" class="btn btn-defult btn-primary">Back</a>
				<a href="service-details.php?confirm=true" class="btn btn-defult btn-primary">Confirm</a>
			</div>
		</div>
	</div>
	
	
	
	<?php include('template/footer.php') ?>
</body>
</html>