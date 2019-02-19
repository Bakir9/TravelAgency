<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
	<link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
	<link type="text/css" rel="stylesheet" href="css/animate.css"  media="screen,projection"/>
	  <!-- Google fonts-->
	 <link href="https://fonts.googleapis.com/css?family=Anton|Bowlby+One+SC|Cabin" rel="stylesheet">
	 <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
	 <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Agencija</title>
</head>
<body>

<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>
	
	<?php  include 'templates/header.php'; ?> 

	<div class="row">
		<div class="col s6 offset-s1 ">
			<h4 class="touch">Get in Touch</h4>
			<p class="fillForm">Please fill out the quick form and we will be in touch
				with lightening speed.
			</p>
			<div class="row">
				<div class="input-field col s4">
					<i class="material-icons prefix">account_circle</i>
					<input id="icon_prefix" type="text" class="validate">
					<label for="icon_prefix">First Name</label>
				</div>
				<div class="input-field col s4">
					<i class="material-icons prefix">account_circle</i>
					<input id="icon_prefix" type="text" class="validate">
					<label for="icon_prefix">Last Name</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s8">
					<i class="material-icons prefix">email</i>
					<input id="icon_prefix" type="text" class="validate">
					<label for="icon_prefix">E-mail</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s8">
					<i class="material-icons prefix">mode_edit</i>
					<textarea id="icon_prefix2" class="materialize-textarea"></textarea>
					<label for="icon_prefix2">Message</label>
				</div>
			</div>
			<div class="row">
				<col class="s6">
				<button class="btn waves-effect waves-light" type="submit" name="action">Submit
					<i class="material-icons right">send</i>
				</button>
			</div>
		</div>
		<div class="col s5">
			<h4 class="touch"> <b>Connect with us:</b></h4>
			<p class="support">For support or any questions:</p>
			<p class="support" style="margin-top:5px;">E-mail us at: <span style="color:#03a9f4;">travelagency@gmail.com</span></p>

			<p class="adress1" style="margin-top: 40px;"><b>Travel Agency BiH</b></p>
			<p class="adress1">785 Adress Road, City 210</p>
			<p class="adress1">City, City 1840</p>
			<p class="adress1">Bosnia and Herzegovina</p>

			<p class="adress1" style="margin-top: 40px;"><b>Travel Agency BiH</b></p>
			<p class="adress1">785 Adress Road, City 210</p>
			<p class="adress1">City, City 1840</p>
			<p class="adress1">Bosnia and Herzegovina</p>
		</div>
	</div>

	<?php  include 'templates/footer.php'; ?> 
    <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>