<?php 
	 include('db/konekcija.php');
	 if (session_status() == PHP_SESSION_NONE) {
	  session_start();
	}  
	  $query = "SELECT * FROM destinacije ORDER BY id DESC LIMIT 3 "; 
	  
?>
<!DOCTYPE html>
  <html>
    <head>
	<meta charset="UTF-8">
			<!-- Compiled and minified CSS -->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

			<!-- Compiled and minified JavaScript -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
			<!--Import Google Icon Font-->
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<!--Import materialize.css-->
			<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
			<link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
			<link type="text/css" rel="stylesheet" href="css/animate.css"  media="screen,projection"/>
			<!-- Google fonts-->
			<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Anton|Staatliches" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

			<!--Let browser know website is optimized for mobile-->
			<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

			<!-- Sweet alert -->
			<script src="js/sweetalert2.all.min.js"></script>
			<script src="js/sweetalert2.min.js"></script>
			<link rel="stylesheet" href="css/sweetalert2.min.css">
    </head>
    <title>Turistička agencija</title>

    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>

      
      <?php  include 'templates/header.php'; ?> 
     
	<div class="row">
		<!--<div id="tabovi" class="col s6 offset-s1" style="padding-left: 0;">
			<ul class="tabs tabs-fixed-width">
				<li class="tab col s2" style="background-color:rgb(55, 201, 238);"><a href="#test1" class="white-text no-uppercase" style="font-size:18px;">Flights</a></li>
				<li class="tab col s2" style="background-color:rgb(55, 201, 238);"><a href="#test2" class="white-text no-uppercase" style="font-size:18px;">Cruises</a></li>
				<li class="tab col s2" style="background-color:rgb(55, 201, 238);"><a href="#test3" class="white-text no-uppercase" style="font-size:18px;">Cars</a></li>
				<div class="indicator yellow" style="z-index:1"></div>
			</ul>
		</div>-->
		<!--<div id="test1" class="col s9 offset-s1 z-depth-3" style="border-bottom: 2px solid #29b6f6;">
			<div class="row">
				<div class="col s2">
					<label style="font-size:16px;">From</label>
					<select>
						<option value="1">Sarajevo</option>
						<option value="2">Bihać</option>
						<option value="3">Zenica</option>
						<option value="4">Mostar</option>
						<option value="5">Tuzla</option>
					</select>
				</div>
				<div class="col s2">
					<label style="font-size:16px;">To:</label>
					<select>
						<option value="1">Bali</option>
						<option value="2">Zanzibar</option>
						<option value="3">China</option>
						<option value="3">Budva</option>
						<option value="3">Philiphines</option>
					</select>
				</div>
				<div class="col s2">
					<button class="mt btn waves-effect waves-light " type="submit" name="action">
						Search
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
		</div>-->

		<!--<div id="test2" class="col s9 offset-s1 z-depth-3" style="border-bottom: 2px solid #29b6f6;">
			<div class="row">
				<div class="col s3">
					<label style="font-size:16px !important;">Sail to</label>
					<select>
						<option value="1">Neum</option>
						<option value="2">Rovinj</option>
						<option value="3">Pula</option>
						<option value="3">Zadar</option>
					</select>
				</div>-->

			<!--	<div class="col s3">
					<label style="font-size:16px !important;">Sail from</label>
					<select>
						<option value="1">Neum</option>
						<option value="2">Rovinj</option>
						<option value="3">Pula</option>
						<option value="3">Zadar</option>
					</select>
				</div>

				<div class="col s2">
					<label for="odlazak" style="font-size:16px;">Start Date:</label>
					<input id="odlazak" type="text" class="datepicker">
				</div>

				<div class="col s2">
					<label for="odlazak" style="font-size:16px;">End of Date:</label>
					<input id="odlazak" type="text" class="datepicker">
				</div>

				<div class="col s2">
					<button class="mt btn waves-effect waves-light " type="submit" name="action">
						Search
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
		</div>-->

		<!--<div id="test3" class="col s9 offset-s1 z-depth-3" style="border-bottom: 2px solid #29b6f6;">
			<div class="row">
				<div class="col s2">
					<label style="font-size:16px !important;">Country</label>
					<select>
						<option value="1">BiH</option>
						<option value="2">Croatia</option>
						<option value="3">England</option>
						<option value="4">Turkey</option>
						<option value="5">SAD</option>
					</select>
				</div>
				<div class="col s2">
					<label style="font-size:16px !important;">City</label>
					<select>
						<option value="1">Bihać</option>
						<option value="2">Zagreb</option>
						<option value="3">Manchester</option>
						<option value="4">Ankara</option>
						<option value="5">Chicago</option>
					</select>
				</div>

				<div class="col s2">
					<label style="font-size:16px !important;">Location</label>
					<select>
						<option value="">Please select</option>
						<option value="1">Bihać</option>
						<option value="2">Zagreb</option>
						<option value="3">Manchester</option>
						<option value="4">Ankara</option>
						<option value="5">Chicago</option>
					</select>
				</div>

				<div class="col s2">
					<label for="odlazak" style="font-size:16px;">Pick up Date:</label>
					<input id="odlazak" type="text" class="datepicker">
				</div>

				<div class="col s2">
					<label for="odlazak" style="font-size:16px;">Drop off Date:</label>
					<input id="odlazak" type="text" class="datepicker">
				</div>

				<div class="col s2">
					<button class="mt btn waves-effect waves-light " type="submit" name="action">
						Search
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
		</div>-->
	</div>

	<div class="row">
		<div class="col s12">
			<h3 class="center-align best">WHY WE ARE THE BEST</h3>
		</div>
	</div>
	<div class="row">
		<div class="col s8 offset-s2">
				<p class="center-align opis">Lorem ipsum dolor sit amet,
				consectetur adipiscing elit, sed do eiusmod tempor incididunt
				ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate</p>
		</div>
	</div>
	<div class="row">
		<div class="col s3 center-align">
			<i class="material-icons ikone">flight_land</i>
			<h5 class="popular" style="margin-top:0;">Amazing Travel</h5>
			<p class="center-align offer">
				Lorem ipsum dolor sit amet,
				consectetur adipiscing elit. Duis aute irure dolor in reprehenderit in voluptate
			</p>
		</div>
		<div class="col s3 center-align">
				<i class="material-icons ikone">hotel</i>
				<h5 class="popular" style="margin-top:0;">Exclusiv Hotel</h5>
				<p class="center-align offer">
					Lorem ipsum dolor sit amet,
					consectetur adipiscing elit. Duis aute irure dolor in reprehenderit in voluptate
				</p>
		</div>
		<div class="col s3 center-align">
				<i class="material-icons ikone">wb_sunny</i>
				<h5 class="popular" style="margin-top:0;">Exotic destinations</h5>
				<p class="center-align offer">
					Lorem ipsum dolor sit amet,
					consectetur adipiscing elit. Duis aute irure dolor in reprehenderit in voluptate
				</p>
		</div>
		<div class="col s3 center-align">
				<i class="material-icons ikone">event</i>
				<h5 class="popular" style="margin-top:0;">Amazing Event</h5>
				<p class="center-align offer">
					Lorem ipsum dolor sit amet,
					consectetur adipiscing elit. Duis aute irure dolor in reprehenderit in voluptate
				</p>
		</div>
	</div>

	<div class="row">
		<div class="col s12" style="padding:0;">
			<div class="pozadina" style="border-bottom: 3px solid #29b6f6;">
				<div class="row">
					<div class="col s10">
						<p class="left-align yellow-text text-lighten-3 opis3">
							Take advantage of the discount at the best locations from our offer.</p>
						<p class="left-align white-text opis2">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
							Duis aute irure dolor in reprehenderit in voluptate. Lorem ipsum dolor sit amet, 
							consectetur adipiscing elit.
						</p>
					</div>
					<div class="col s2">
						<button class="btn waves-effect waves-light details" href="#" type="submit" name="action">DETAILS</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
			<div class="col s12">
				<h3 class="center-align best">POPULAR PLACES</h3>
			</div>
	</div>
	<div class="row">
		<div class="col s8 offset-s2">
				<p class="center-align opis">Lorem ipsum dolor sit amet,
				consectetur adipiscing elit, sed do eiusmod tempor incididunt
				ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate</p>
		</div>
	</div>
<div class="container">
	<div class="row">
	<?php 
		if( $res = mysqli_query($conn, $query)){
			if(mysqli_num_rows($res) > 0){
				while ($row = mysqli_fetch_array($res)){
	?>
		<div class="col s4">
			<div id="kartica" class="card hoverEffect z-depth-5" >
				<div class="card-image" style="height: 250px;">
					<img src="images/<?php echo $row['slika']; ?>" style="height: 250px;">
				</div>
				<div class="card-content" style="padding-bottom:0;">
					<span class="card-title ponuda"><?php echo $row['naziv_destinacije']; ?></span>
						<div class="row">
							<div class="col s12">
								<div class="row">
									<div class="col s6">
										<p class="detaljiDestinacije"><?php echo $row['brojDanaPansiona']; ?> days</p>
									</div>
									<div class="col s6">
										<p class="detaljiDestinacije"><?php echo $row['cijena_destinacije']; ?> KM</p>
									</div>
								</div>
							</div>
						</div>
				</div>
				<div class="card-action" style="border-bottom: 3px solid #368ce7;">
					<a href="detaljiDestinacije.php?id=<?= $row['id'] ?>">Details</a>
					<a href="#">Reservation</a>
				</div>
			</div>
		</div>
		<?php
			}
		}
	}
	?>
	</div>
</div>
	<?php  include 'templates/footer.php'; ?> 
	

		<script>
			$(document).ready(function(){
				$('.tabs').tabs();
			});

			document.addEventListener('DOMContentLoaded', function() {
				var elems = document.querySelectorAll('select');
				var options = {}
				var instances = M.FormSelect.init(elems, options);
			});

			document.addEventListener('DOMContentLoaded', function() {
				var elems = document.querySelectorAll('.datepicker');
				var options = {}
				var instances = M.Datepicker.init(elems, options);
			});

			$('.hoverEffect').hover (
				function(){ $(this).addClass('okolo') },
				function() { $(this).removeClass('okolo')}
			)
		</script>
		<script type="text/javascript" src="js/materialize.js"></script>
		
    </body>
  </html>