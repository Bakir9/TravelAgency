<?php 
include('db/konekcija.php');
if (session_status() == PHP_SESSION_NONE) {
 session_start();
}  
    $id_destinacije = $_GET['id'];

    $query = "SELECT * FROM destinacije WHERE id = $id_destinacije";
    $result = mysqli_query($conn, $query);
    $r = mysqli_fetch_assoc($result);

    $sql = "SELECT * FROM dani WHERE id_destinacije = $id_destinacije";
    $res = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
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
        <title>Details</title>
</head>

<body>
     <!--Import jQuery before materialize.js-->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>

      
      <?php  include 'templates/header.php'; ?> 

    <div class="row" style="padding-right:0;">
        <div class="col s9 proba" style="margin-top:20px;">
            <img src="images/<?php echo $r['slika'] ?>" style="width:995px; height: 400px;" alt="">
            <div class="row" style="margin-bottom:0;">
                <div class="overlay">
                    <div class="col s2 text" >
                        <p style="margin:5px 0 0 0;"><?php echo $r['naziv_destinacije'] ?></p>   
                    </div>
                    <div class="col s2 text" style="padding:0;">
                        <p style="margin:5px 0 0 0;"><?php echo $r['cijena_destinacije'] ?> KM</p> 
                    </div>
                    <div class="col s2 text" style="padding:0;">
                        <p style="margin:5px 0 0 0;"><?php echo $r['brojDanaPansiona'] ?> Days</p> 
                    </div>
                    <div class="col s4 text" style="padding:0;">
                        <p style="margin:5px 0 0 0;">Start: <?php echo $r['datum_destinacije'] ?></p> 
                    </div>
                    <div class="col s2 text" style="padding:0;">
                        <p style="margin:5px 0 0 0;">Flight: <?php echo $r['let_destinacije'] ?></p> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col s3 z-depth-3 center-align" style="margin-top:20px;">
            <p class="reservation">Book now</p>
            <form>
                <div class="input-field  offset-s1" style="margin-left:10px;">
                    <input placeholder="First Name" id="first_name" type="text" class="validate">
                    <label for="first_name">First Name</label>
                </div>
                <div class="input-field " style="margin-left:10px;">
                    <input placeholder="Last Name" id="last_name" type="text" class="validate">
                    <label for="last_name">Last Name</label>
                </div>
                <div class="input-field " style="margin-left:10px;">
                    <input placeholder="E-mail" id="e-mail" type="text" class="validate">
                    <label for="e-mail">E-mail</label>
                </div>
                <div class="input-field center-align">
                    <button class="btn waves-effect waves-light" value="submit"
                        type="submit" name="dodaj"  style="margin-bottom:15px;">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col s2">
            <p style="font-family: 'Raleway', sans-serif; font-size: 18px; margin:0;"> </p>
        </div>
    </div>
    <div class="row">
        <div id="tabovi" class="col s4" style="margin-left: 20px;">
            <ul class="tabs tabs-fixed-width">
                <li class="tab col s2" style="background-color:rgb(55, 201, 238);"><a href="#test1" class="white-text no-uppercase" style="font-size:18px;">About destination</a></li>
                <li class="tab col s2" style="background-color:rgb(55, 201, 238);"><a href="#test2" class="white-text no-uppercase" style="font-size:18px;">Remark</a></li>
                <div class="indicator yellow" style="z-index:1"></div>
            </ul>
        </div>
        <div id="test1" class="col s9 z-depth-3" style="border-bottom: 2px solid #29b6f6; margin-left: 30px;">
            <div class="row" style="margin-bottom:0;">
                <div class="col s12">
                    <p style="font-family: 'Raleway', sans-serif;"><?php echo $r['Opis'] ?></p>
                </div>
            </div>
            <?php 
            if( $res = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($res) > 0){
                    while ($row = mysqli_fetch_array($res)){
            ?>
            <div class="row" style="margin-bottom:0;">
                <div class="col s12">
                    <p style="margin-bottom: 0px; margin-top: 10px; font-size:16px; font-family: 'Raleway', sans-serif;">
                        <b>
                            <?php echo $row['broj_dana']?>
                        </b>
                    </p>
                </div>
                <div class="col s12">
                    <p style="margin-top: 5px; font-size:14px; font-family: 'Raleway', sans-serif; "><?php echo $row['opis_dana'] ?></p>
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
        <script type="text/javascript" src="js/materialize.js"></script>
        <script>
            $(document).ready(function(){
                    $('.tabs').tabs();
                });
        </script>
    
</body>
</html>