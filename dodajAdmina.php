<?php 
    include('db/konekcija.php');
    if (session_status() === PHP_SESSION_NONE) {
     session_start();
   }  
    include('log.php');
        $poruka="";
        $poruka1="";
        $poruka2="";
        $poruka3="";
        $poruka4="";
        $message =" ";
        
    if(isset($_POST['dodaj'])){
        
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $email = $_POST['email'];
        $user = $_POST['user'];
        $sifra = $_POST['sifra'];
        $datum = date("d/m/Y");
        $vrijeme = date("h:i:sa");
        
        if($_POST['admin'] == 'admin'){
            $vrsta = "administrator";
        }
        else {
            $vrsta = "GlavniAdministrator";
        }
        
        if(!preg_match("/^[a-zA-Z ]*$/",$ime) || empty($ime)){
            $poruka="Unesite podatke !";
        }

        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $poruka2 ="Nije validan format !";
        } 
        else if(!preg_match("/^[a-zA-Z ]*$/",$user) || empty($user)){
            $poruka3="Unesite podatke!";
        }
        
        else {
            $query = "INSERT INTO korisnici VALUES ('0', '$ime', '$prezime', '$email', '$user', '$sifra', '$vrsta')";
            $result = mysqli_query($conn, $query);

            if($result){
                $dbidkorisnika = $_SESSION['id_kor'];
                $korisnik = $_SESSION['korisnik'];
                $nazivAktivnosti = "Dodavanje admina";
                logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);
                $message = '<div id="message" class="col s12">
                        <div class="row card-panel light-green accent-2">
                            <div class="green-text text-light-green darken-4 col s12">Uspješno dodan novi administrator !</div>
                        </div>
                    </div>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/styleAdmin.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/animate.css"  media="screen,projection"/>
        <!-- Google fonts-->
      <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Anton|Staatliches" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
          <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
     
</head>
    <title>Admin panel</title>
<body>
        
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>
      
      <?php  include 'adminPanel.php'; ?> 
            <div class="col s6 z-depth-4" style="margin-left: 20px; margin-top: 10px; padding:0;">
                <div class="row" style="background-color:rgb(99, 194, 226); margin-bottom: 10px;">
                    <div class="col s12 left-align" style="height:80px;">
                        <h4 style="margin-bottom:0; color:white; font-size:45px;">Add admin</h4>
                    </div> 
                </div>
                <div class="row" style="margin-bottom:0;">
                    <?php echo $message ?>
                </div>
                <form action="dodajAdmina.php"  method="POST">
                    <div class="row">
                        <div class="col s6">
                            <div class="input-field">
                                    <i class="material-icons prefix">person</i>
                                    <input  type="text" id="ime" name="ime" >
                                    <label for="ime">Name</label>
                                    <span class="red-text"><?php echo $poruka ?></span>
                            </div>
                        </div>
                        <div class="col s6">
                                <div class="input-field">
                                        <i class="material-icons prefix">person</i>
                                        <input  type="text" id="prezime" name="prezime" >
                                        <label for="prezime">Surname</label>
                                </div>
                         </div>
                    </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="input-field">
                                        <i class="material-icons prefix">mail</i>
                                        <input  type="text" id="email" name="email">
                                        <label for="email">E-mail</label>
                                        <span class="red-text"><?php echo $poruka2 ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6">
                                <div class="input-field">
                                        <i class="material-icons prefix">person</i>
                                        <input  type="text" id="user" name="user" >
                                        <label for="user">Username</label>
                                        <span class="red-text"><?php echo $poruka3 ?></span>
                                </div>
                            </div>
                            <div class="col s6">
                                <div class="input-field">
                                        <i class="material-icons prefix">https</i>
                                        <input  type="password" id="sifra" name="sifra" >
                                        <label for="sifra">Password</label>
                                        <span class="red-text"><?php echo $poruka3 ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6">
                                <p>
                                    <input type="checkbox" class="filled-in"  id="admin" name="admin" value="admin">
                                    <label for="admin">Admin</label>
                                </p>
                            </div>
                            <div class="col s6">
                                <p>
                                    <input type="checkbox" class="filled-in"  id="headAdmin" name="admin" value="headAdmin">
                                    <label for="headAdmin">Head Admin</label>
                                </p>
                            </div>
                        </div>
                        <div class="input-field center-align">
                            <button class="btn waves-effect waves-light" value="submit"
                             type="submit" name="dodaj"  style="margin-bottom:15px;">
                                Dodaj
                            </button>
                         </div>
                </form>
            </div>
        </div>
   
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/validacija.js"></script>
    <script type="text/javascript">
        $('.filled-in').on('change', function() {
            $('.filled-in').not(this).prop('checked', false);
        });
    </script>

    <!-- Sweet alert -->
	<script src="js/sweetalert2.all.min.js"></script>
	<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
	<script src="js/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/sweetalert2.css">
    
    <script>
        function validacija(){
            var ime = document.getElementById('ime').value;
            if(ime == ""){
				document.getElementById('ime').innerHTML =" ** Please fill the username field";
				return false;
			}
        }

        $(document).ready(function () {
        setTimeout(function () {
            $('#message').hide();
        }, 3000);
        });
    </script>
</body>
</html>