	<?php include ('template/header.php'); ?>
	<title>Courier || Home</title>
</head>
<body>
	<?php include('template/nav.php');


$call = $connection->prepare("SELECT * FROM `branch`");
$call->execute();
$getdbvalue = $call->fetchAll();

 ?>
	
	<div class="container">
		<div class="row">
			<h4 class="b_title">Our Branches</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
	</div>
	<div class="container">
		<div class="row">
            <?php foreach ($getdbvalue as $tablem ){ ?>
            <div class="col-lg-3">   

                <h4 class="bre_title"><?php echo $tablem["branch_name"];?></h4>
	            <p> <i class="fa fa-map-marker"><?php echo $tablem["b_location"];?></i></p>
	            <p><i class="fa fa-phone"></i><?php echo $tablem["b_phone"];?></p>
	            <p><i class="fa fa-envelope"></i><?php echo $tablem["b_email"];?></p>
            </div>
            <?php } ?>
            

		</div>
	</div>
    
    




	
	
	
	
	<?php include('template/footer.php') ?>
</body>
</html>