<?php 
include('db/konekcija.php');
if (session_status() == PHP_SESSION_NONE) {
 session_start();
}  
    $id_destinacije = $_GET['id'];
    $message ="";
    if(isset($_GET['id'])){
        $query = "SELECT * FROM destinacije WHERE id = $id_destinacije";
        $result = mysqli_query($conn, $query);
        $r = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM dani WHERE id_destinacije = $id_destinacije";
        $res = mysqli_query($conn, $sql);
    }
    
    if(isset($_POST['rezervacija'])){

        if(!empty($brojPutnika)){
            $brojPutnika = $_POST['brojPutnika'];
            $dodatna = $_POST['dodatna'];
            $idKorisnika = $_SESSION['id_kor'];

            $upit = "INSERT INTO rezervacije VALUES ('0', '$id_destinacije', '$idKorisnika', '$brojPutnika', '$dodatna')";
            $rezultat = mysqli_query($conn, $upit);

            if($rezultat){
                $dbidkorisnika = $_SESSION['id_kor'];
                $korisnik = $_SESSION['korisnik'];
                include('log.php');
                $nazivAktivnosti = "Rezervacija od korisnika $idKorisnika";
                logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);
                $message = '<div id="message" class="col s12">
                                <div class="row card-panel light-green accent-2">
                                    <div class="green-text text-light-green darken-4 col s12">Uspješna rezervacija !</div>
                                </div>
                            </div>';
            }
        }
        else {
            $message = '<div id="message" class="col s12">
                            <div class="row card-panel red darken-4">
                                <div class="white-text center-align s12">Unesit broj putnika !</div>
                            </div>
                        </div>';
            } 
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include 'templates/headerPage.php'; ?>
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
            <form action="" method="POST">
                <div class="input-field " style="margin-left:10px;">
					<select name="brojPutnika">
                        <option value="">Broj putnika</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
					</select>
                </div>
                <div class="input-field " style="margin-left:10px;">
                    <textarea id="textarea" class="materialize-textarea" name="dodatna"></textarea>
                    <label for="textarea2">Dodatna pitanja</label>
                </div>
                <div class="input-field center-align">
                <?php if (empty($_SESSION['id_kor'])): ?>
                    <button  class="disabled btn waves-effect waves-light tooltipped" value="submit" 
                    data-position="top" data-tooltip="You must login" style="margin-bottom:15px;">
                        Submit
                    </button>
                <?php else: ?>
                    <button class="btn waves-effect waves-light" value="submit" name="rezervacija" 
                    style="margin-bottom:15px;">
                        Submit
                    </button>
                <?php endif?>
                </div>
                <?php echo $message ?>
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
        	document.addEventListener('DOMContentLoaded', function() {
				var elems = document.querySelectorAll('select');
				var options = {}
				var instances = M.FormSelect.init(elems, options);
			});
            $(document).ready(function(){
                    $('.tabs').tabs();
                });

            document.addEventListener('DOMContentLoaded', function() {
                var elems = document.querySelectorAll('.tooltipped');
                var instances = M.Tooltip.init(elems, options);
            });

            $(document).ready(function () {
                setTimeout(function () {
                    $('#message').hide();
                }, 3000);
                });
        </script>
    
</body>
</html>