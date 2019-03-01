<?php 
    include('db/konekcija.php');
    session_start();
    $message = "";
    
    if(isset($_POST['submit'])){
        
        $korisnik = $_POST['korisnicko_ime'];
        $loz = $_POST['sifra'];
        $datum = date("d/m/Y");
        $vrijeme = date("h:i:sa");
            $query = "SELECT * FROM korisnici where korisnicko_ime = '$korisnik' and 
            sifra = '$loz'"; 
           
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
           
            if(empty($korisnik) || empty($loz)){
                $message = '<div id="message" class="col s12">
                                <div class="row card-panel red darken-4">
                                    <div class="white-text center-align s12">Pogrešni podaci !</div>
                                </div>
                            </div>';
            }
            else if($row['korisnicko_ime'] == $korisnik && $row['sifra'] == $loz ){
                
                $dbidkorisnika = $row['id_korisnika'];
                $dbime  = $row['ime'];
                $dbprezime = $row['prezime'];
                $korisnik = $row['korisnicko_ime'];
                $tip = $row['tip'];
                $_SESSION['id_kor'] = $dbidkorisnika;
                $_SESSION['korisnik'] = $korisnik;
                $_SESSION['tip'] = $tip;
                
                include('log.php');
                $nazivAktivnosti = "Prijava";
                logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);
                header('Location: index.php');
                
                
            }
            else {
                $message = '<div id="message" class="col s12">
                                <div class="row card-panel red darken-4">
                                    <div class="white-text center-align s12">Pogrešni podaci, probajte ponovo !</div>
                                </div>
                            </div>';
                } 
        }
     
?>
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
	 <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	 <link href="https://fonts.googleapis.com/css?family=Anton|Staatliches" rel="stylesheet">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <title>Login</title>

    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>

    <div class="row prijava">
        <div class="col s4 offset-s4">
            <form action="" method="POST">
                <div class="card">
                    <div class="card-action red white-text">
                        <h3>Login Form</h3>
                    </div>
                    <div class="card-content">
                        <div class="input-field">
                            <label for="korisnicko_ime">Username</label>
                            <input type="text" id="korisnicko_ime" name="korisnicko_ime">
                        </div> <br>
                        <div class="input-field">
                            <label for="sifra">Password</label>
                            <input type="password" id="sifra" name="sifra">
                        </div>
                        <div class="center-align input-field">
                            <button class="btn-large red" value="submit"
                            type="submit" name="submit">Login</button>
                            <a href="index.php" style="margin-left: 20px;">Back to home</a>
                        </div>
                           
                    </div>
                </div>
            </form>
        </div>
        <div class="col s4">
            <?php echo $message ?>
        </div>
    </div>
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script>
        $(document).ready(function () {
        setTimeout(function () {
            $('#message').hide();
        }, 2000);
        });
    </script>
    </body>
</html>