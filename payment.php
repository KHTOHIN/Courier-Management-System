	<?php include ('template/header.php'); ?>
	<title>Courier || Home</title>
</head>
<body>
	<?php include('template/nav.php'); 

	$statment = $connection->prepare("SELECT `payment_id`, `payment_type_name`, `payment_tax` FROM `payment`");
	$get = $statment->execute();
	$payments = $statment->fetchAll();


	?>
	

	<div class="container">
		<div class="row">
				<div class="col-lg-4 col-lg-offset-4">
					<form method="post" action="courier.php">
						<?php if (!empty($payments)): 
						$i = 0;
						?>
							<?php foreach ($payments as $pay): 

							?>
								<div class="radio">
								  	<label><input <?php if($i==0) echo '" checked="checked" '; ?> type="radio" name="payments" value="<?=$pay["payment_id"];?>"><?=$pay["payment_type_name"];?></label>
								</div>
							<?php $i++; endforeach ?>
						<?php endif ?>
					  	<div class="form-groups">
					  		<div class="row">
					  			<div class="col-md-6"><a class="btn btn-default btn-primary" href="service-details.php">Back</a></div>
					  			<div class="col-md-6"><input class="btn btn-default btn-primary" type="submit" name="completePayment" value="Complete Payment" ></div>
					  		</div>
					  		
					  		
					  	</div>
					</form>
				</div>
		</div>
	</div>
	<?php include('template/footer.php') ?>
</body>
</html>