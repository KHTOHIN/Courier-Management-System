	<?php include ('template/header.php');?>
	<title>Courier || Service</title>
</head>
<body>
	<?php include('template/nav.php');

	// getting branch value by id
	$statment = $connection->prepare("SELECT * FROM `branch`");
	$get = $statment->execute();
	$branches = $statment->fetchAll();

	$errors = array();

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["booking"])) {

		$v = new Valitron\Validator($_POST);

		$v->rule('required', ['frombranch', 'sendername', 'senderemail', 'senderphone', 'senderadd', 'ptype', 'weidht', 'pdetails', 'tobranch', 'receivername', 'receiveremail',  'receiverphone', 'receiveradd']);

		$v->rule('email', 'senderemail');
		$v->rule('email', 'receiveremail');

		$Fbranch  = inputValid($_POST["frombranch"]);
		$sendername  = inputValid($_POST["sendername"]);
		$senderemail  = inputValid($_POST["senderemail"]);
		$senderphone  = inputValid($_POST["senderphone"]);
		$senderadd  = inputValid($_POST["senderadd"]);
		$ptype  = inputValid($_POST["ptype"]);
		$productName  = inputValid($_POST["productName"]);
		$weidht  = (float) inputValid($_POST["weidht"]);
		$pdetails  = inputValid($_POST["pdetails"]);
		$tobranch  = inputValid($_POST["tobranch"]);
		$receivername  = inputValid($_POST["receivername"]);
		$receiveremail  = inputValid($_POST["receiveremail"]);
		$receiverphone  = inputValid($_POST["receiverphone"]);
		$receiveradd  = inputValid($_POST["receiveradd"]);

        setSessionMessage("frombranch", $Fbranch);
        setSessionMessage("sendername", $sendername);
        setSessionMessage("senderemail", $senderemail);
        setSessionMessage("senderphone", $senderphone);
        setSessionMessage("senderadd", $senderadd);
        setSessionMessage("ptype", $ptype);
        setSessionMessage("productName", $productName);
        setSessionMessage("weidht", $weidht);
        setSessionMessage("pdetails", $pdetails);
        setSessionMessage("tobranch", $tobranch);
        setSessionMessage("receivername", $receivername);
        setSessionMessage("receiveremail", $receiveremail);
        setSessionMessage("receiverphone", $receiverphone);
        setSessionMessage("receiveradd", $receiveradd);

		if(!$v->validate()) {
	        $errors = $v->errors();
	    }else{
	    	redirect("service-details.php");
	    	return;
	    }
	}



	?>
	
	<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php 
                if(isset($_SESSION["curiermsg"])) {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php getSessionMessage("curiermsg"); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
		<div class="row">
			<form id="courierForm" action="" method="post">

				<div class="col-lg-4">
					<h1>From:</h1>

					<div class="form-group">
						<label for="frombranch">Branch: </label>
						<select name="frombranch" id="frombranch" class="form-control <?php if(isset($errors["frombranch"])) echo "error_input"; ?>">
							<?php if (!empty($branches)): ?>
								<?php foreach ($branches as $branch): ?>
									<option value="<?php echo $branch["branch_name"]; ?>"><?php echo $branch["branch_name"]; ?></option>
								<?php endforeach ?>
							<?php endif ?>
						</select>
                        <?php if (isset($errors["frombranch"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["frombranch"]); ?></span>
                        <?php endif ?>
					</div>

					<div class="form-group">
						<label for="sname">Name: </label>
						<input type="text" name="sendername" id="sname" class="form-control <?php if(isset($errors["sendername"])) echo "error_input"; ?>" placeholder="your full name" value="<?php getSessionMessage("sendername"); ?>">

                        <?php if (isset($errors["sendername"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["sendername"]); ?></span>
                        <?php endif ?>
					</div>
					<div class="form-group">
						<label for="semail">Email: </label>
						<input type="email" name="senderemail" id="semail" class="form-control <?php if(isset($errors["senderemail"])) echo "error_input"; ?>" placeholder="you@domain" value="<?php getSessionMessage("senderemail"); ?>">
						<?php if (isset($errors["senderemail"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["senderemail"]); ?></span>
                        <?php endif ?>
					</div>
					<div class="form-group">
						<label for="sphone">Phone: </label>
						<input type="text" name="senderphone" id="sphone" class="form-control <?php if(isset($errors["senderphone"])) echo "error_input"; ?>" placeholder="+880 1*******" value="<?php getSessionMessage("senderphone"); ?>" >
						<?php if (isset($errors["senderphone"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["senderphone"]); ?></span>
                        <?php endif ?>

					</div>
					<div class="form-group">
						<label for="sadd">Add: </label>
						<input type="text" name="senderadd" id="sadd" class="form-control <?php if(isset($errors["senderadd"])) echo "error_input"; ?>" placeholder="" value="<?php getSessionMessage("senderadd"); ?>" >
						<?php if (isset($errors["senderadd"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["senderadd"]); ?></span>
                        <?php endif ?>
					</div>
				</div>

				<div class="col-lg-4">
					<h1>Prodect</h1>
					<div class="form-group">
						<label for="productType">Product Type: </label>
						<select name="ptype" id="productType" class="form-control <?php if(isset($errors["ptype"])) echo "error_input"; ?>">
							<option value="computer">Computer</option>
							<option value="letter">Letter</option>
							<option value="etc">etc Etc</option>
						</select>
						<?php if (isset($errors["ptype"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["ptype"]); ?></span>
                        <?php endif ?>
					</div>

					<div class="form-group">
						<label for="productName">Product Name: </label>
						<input type="text" name="productName" id="Weidht" class="form-control <?php if(isset($errors["productName"])) echo "error_input"; ?>" placeholder="laptop" value="<?php getSessionMessage("productName"); ?>">
						<?php if (isset($errors["productName"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["productName"]); ?></span>
                        <?php endif ?>
					</div>

					<div class="form-group">
						<label for="Weidht">Weidht: </label>
						<input type="text" name="weidht" id="Weidht" class="form-control <?php if(isset($errors["weidht"])) echo "error_input"; ?>" placeholder="kg" value="<?php getSessionMessage("weidht"); ?>">
						<?php if (isset($errors["weidht"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["weidht"]); ?></span>
                        <?php endif ?>
					</div>
					<div class="form-group">
						<label for="Productdetails">Product Details: </label>
						<input type="text" name="pdetails" id="Productdetails" class="form-control <?php if(isset($errors["pdetails"])) echo "error_input"; ?>" placeholder="" value="<?php getSessionMessage("pdetails"); ?>">
						<?php if (isset($errors["pdetails"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["pdetails"]); ?></span>
                        <?php endif ?>
					</div>
				</div>

				
				<div class="col-lg-4">
					<h1>Receiver:</h1>
					<div class="form-group">
						<label for="receiverbranch">Branch: </label>
						<select name="tobranch" id="receiverbranch" class="form-control <?php if(isset($errors["tobranch"])) echo "error_input"; ?>">
							<?php if (!empty($branches)): ?>
								<?php foreach ($branches as $branch): ?>
									<option value="<?php echo $branch["branch_name"]; ?>"><?php echo $branch["branch_name"]; ?></option>
								<?php endforeach ?>
							<?php endif ?>
						</select>
					</div>
					<div class="form-group">
						<label for="rname">Name: </label>
						<input type="text" name="receivername" id="rname" class="form-control <?php if(isset($errors["receivername"])) echo "error_input"; ?>" placeholder="your full name" value="<?php getSessionMessage("receivername"); ?>">
						<?php if (isset($errors["receivername"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["receivername"]); ?></span>
                        <?php endif ?>
					</div>
					<div class="form-group">
						<label for="remail">Email: </label>
						<input type="email" name="receiveremail" id="remail" class="form-control <?php if(isset($errors["receiveremail"])) echo "error_input"; ?>" placeholder="you@domain" value="<?php getSessionMessage("receiveremail"); ?>">
						<?php if (isset($errors["receiveremail"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["receiveremail"]); ?></span>
                        <?php endif ?>
					</div>
					<div class="form-group">
						<label for="rphone">Phone: </label>
						<input type="text" name="receiverphone" id="rphone" class="form-control <?php if(isset($errors["receiverphone"])) echo "error_input"; ?>" placeholder="+880 1*******" value="<?php getSessionMessage("receiverphone"); ?>">
						<?php if (isset($errors["receiverphone"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["receiverphone"]); ?></span>
                        <?php endif ?>
					</div>
					<div class="form-group">
						<label for="radd">Add: </label>
						<input type="text" name="receiveradd" id="radd" class="form-control <?php if(isset($errors["receiveradd"])) echo "error_input"; ?>" placeholder="" value="<?php getSessionMessage("receiveradd"); ?>">
						<?php if (isset($errors["receiveradd"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["receiveradd"]); ?></span>
                        <?php endif ?>
					</div>
				</div>
				<input type="submit" name="booking"  class="btn btn-success" value="Done" >
			</form>
		</div>
	</div>
	
	
	
	
	<?php include('template/footer.php') ?>
</body>
</html>