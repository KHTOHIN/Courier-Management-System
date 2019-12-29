<?php include ('template/header.php') ?>
<title>Courier || Home</title>
</head>
<body>
	<?php include('template/nav.php') ?>

	<div class="container">
		<div class="row">
			<h4>Our Services</h4>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<form id="courierForm" action="" method="post" autocomplete="off">
				<h1>Register:</h1>
				<div style="text-align:center;margin-top:40px;">
					<span class="step">Sender</span>
					<span class="step">Receviour</span>
					<span class="step">Product</span>
					<span class="step">Confirm</span>
					<span class="step">Payment</span>
					<span class="step">Details</span>
				</div>
				<!-- One "tab" for each step in the form: -->
				<div class="tab">Sender
					<div class="form-group">
						<label for="branch">Branch: </label>
						<select name="branch" id="sbranch" class="form-control" oninput="this.className = ''">
							<option value="dhaka">Dhaka</option>
							<option value="comilla">Comilla</option>
							<option value="chandpur">Chandpur</option>
						</select>
					</div>
					<div class="form-group">
						<label for="name">Name: </label>
						<input type="text" name="name" id="sname" class="form-control" placeholder="your full name" oninput="this.className = ''">
					</div>
					<div class="form-group">
						<label for="email">Email: </label>
						<input type="email" name="email" id="semail" class="form-control" placeholder="you@domain" oninput="this.className = ''">
					</div>
					<div class="form-group">
						<label for="phone">Phone: </label>
						<input type="text" name="phone" id="sphone" class="form-control" placeholder="+880 1*******" oninput="this.className = ''">
					</div>
				</div>
				<div class="tab">Receiver
					<div class="form-group">
						<label for="branch">Branch: </label>
						<select name="branch" id="rbranch" class="form-control" oninput="this.className = ''">
							<option value="dhaka">Dhaka</option>
							<option value="comilla">Comilla</option>
							<option value="chandpur">Chandpur</option>
						</select>
					</div>
					<div class="form-group">
						<label for="name">Name: </label>
						<input type="text" name="name" id="rname" class="form-control" placeholder="your full name" oninput="this.className = ''">
					</div>
					<div class="form-group">
						<label for="email">Email: </label>
						<input type="email" name="email" id="remail" class="form-control" placeholder="you@domain" oninput="this.className = ''">
					</div>
					<div class="form-group">
						<label for="phone">Phone: </label>
						<input type="text" name="phone" id="rphone" class="form-control" placeholder="+880 1*******" oninput="this.className = ''">
					</div>
				</div>
				<div class="tab">Product
					<div class="form-group">
						<label for="branch">Branch: </label>
						<select name="branch" id="branch" class="form-control" oninput="this.className = ''">
							<option value="computer">Computer</option>
							<option value="letter">Letter</option>
							<option value="etc">etc Etc</option>
						</select>
					</div>						
				</div>
				<div class="tab">Confirm
					<div class="form-group">
						<label for="branch">Branch: </label>
						<select name="branch" id="branch" class="form-control" oninput="this.className = ''">
							<option value="dhaka">Dhaka</option>
							<option value="comilla">Comilla</option>
							<option value="chandpur">Chandpur</option>
						</select>
					</div>
				</div>
				<div class="tab">Payment
					<div class="form-group">
						<label for="branch">Branch: </label>
						<select name="branch" id="branch" class="form-control" oninput="this.className = ''">
							<option value="bikash">Bikash</option>
							<option value="dutchbanglabank">Dutch Bangla Bank</option>
							<option value="ibbl">IBBL</option>
						</select>
					</div>	
				</div>
				<div class="tab">Details
					<div class="form-group">
						<label for="branch">Branch: </label>
						<select name="branch" id="branch" class="form-control"" oninput="this.className = ''">
							<option value="dhaka">Dhaka</option>
							<option value="comilla">Comilla</option>
							<option value="chandpur">Chandpur</option>
						</select>
					</div>	
				</div>
				<div style="overflow:auto;">
					<div style="float:right;">
						<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
						<button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
					</div>
				</div>
				<!-- Circles which indicates the steps of the form: -->

			</form>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<h4>Choose a service</h4>
			<div class="col-lg-4">
				<h3>Drop OFF</h3>
				<p>An easy way to send documents and parcels – just drop off your parcel at the nearest  Service Point.</p>
				<button class="button">Find location</button>
			</div>
			<div class="col-lg-4">
				<h3>Ship Online</h3>
				<p>The most convenient way to send your documents and parcels! Ship online and schedule a courier to pick up your parcel at your home or office.</p>
				<button class="button">Ship Online Now</button>
			</div>
			<div class="col-lg-4">
				<h3>Call For a pick up</h3>
				<p>LOur friendly team will help you schedule a courier pickup over the phone.</p>
				<div class="call">
					<span>call</span>
					<a href="tel:+88 01764987438">+88 01764987438</a>
				</div>
			</div>
			<div class="col-lg-4">
				<ul>
					<li>No account required</li>
					<li>Ideal for single parcels</li>
					<li>Major credit cards accepted</li>
				</ul>
			</div>
			<div class="col-lg-4">
				<ul>
					<li>No account required</li>
					<li>Ideal for single parcels</li>
					<li>Major credit cards accepted</li>
				</ul>
			</div>
			<div class="col-lg-4">
				<ul>
					<li>No account required</li>
					<li>Ideal for single parcels</li>
					<li>Major credit cards accepted</li>
				</ul>
			</div>	
		</div>
	</div>


	<?php include('template/footer.php') ?>
</body>
</html>