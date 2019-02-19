<?php 
 include('db/konekcija.php');
 if (session_status() == PHP_SESSION_NONE) {
  session_start();
}   
    $poruka="";
    $poruka1="";
    $poruka2="";
    $poruka3="";
    $porukaLoz="";
    $porukaNova="";
    $id = $_GET['id'];
    
    $query = "SELECT * FROM korisnici WHERE id_korisnika = $id"; 

    //osnovni podaci
    if(isset($_POST['uredi'])){
        
        $ime = $_POST["ime"];
        $prezime = $_POST['prezime'];
        $email = $_POST['email'];
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $duzina =strlen($korisnicko_ime);
        if($_POST['admin'] == 'admin'){
            $vrsta = "administrator";
        }
        else {
            $vrsta = "GlavniAdministrator";
        }

        if(!preg_match("/^[a-zA-Z ]*$/",$ime)){
            $poruka="Samo slova !";
        }
        else if(!preg_match("/^[a-zA-Z ]*$/",$prezime)){
            $poruka1="Samo slova !";
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $poruka2 = "Nije validan format!";
        }
        else if(empty($korisnicko_ime) || $duzina < 4 ){
            $poruka3 = "Unesite korisničko ime!";
        }
        else {
            $sql = "UPDATE korisnici SET ime = '$ime', prezime = '$prezime', email = '$email',
            korisnicko_ime = '$korisnicko_ime', tip = '$vrsta' WHERE id_korisnika = $id";
            $res = mysqli_query($conn, $sql);

        if($res){
            header('Location: adminPanel.php');
            //logActivity
            include('log.php');
            $dbidkorisnika = $_SESSION['id_kor'];
            $korisnik = $_SESSION['korisnik'];
            $nazivAktivnosti = "Uredjivanje admina sa id-em: $id";
            logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);
            }
        }
    }
    
    //promjena lozinke
    if(isset($_POST['promjena'])){
        $staraLozinka = $_POST['staraLozinka'];
        $novaLozinka = $_POST['novaLozinka'];
        $dbsifra = $row['sifra'];
       
        if($staraLozinka == $dbsifra && strlen($novaLozinka) > 5){
            
            $sql2 = "UPDATE korisnici SET sifra = '$novaLozinka' WHERE id_korisnika = $id";
            $res = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($result);
            if($res){
            header('Location: adminPanel.php');
            //logActivity
            include('log.php');
            $dbidkorisnika = $_SESSION['id_kor'];
            $korisnik = $_SESSION['korisnik'];
            $nazivAktivnosti = "Admin - Promjena lozinke na korisnickom racunu";
            logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);
            $porukaNova ="Lozinka promjenjena!";
            }
        }
        else {
         $porukaLoz="Pogrešna lozinka !";
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

    <div class="row">
      
       <?php 
       if( $res = mysqli_query($conn, $query)){
           if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_array($res)){
        ?>
        <div class="col s5">
            <form action="" method="POST">
            <div class="card horizontal">
                <div class="card-image">
                 <img src="images/user.png" >
                 <div class="card-action" style="padding-left:0;">
                        <div class="row" style="margin-bottom:0px;">
                            <div class="col s5">
                                <p>
                                    <input type="checkbox" class="filled-in"  id="admin" name="admin" 
                                    value="admin" <?php echo $row['tip']== 'administrator' ? 'checked':'' ?>>
                                    <label for="admin" style="padding-left:25px;">Admin</label>
                                </p>
                            </div>
                            <div class="col s5">
                                <p>
                                    <input type="checkbox" class="filled-in"  id="headAdmin" name="admin" 
                                    value="headAdmin" <?php echo $row['tip']== 'GlavniAdministrator' ? 'checked':'' ?>>
                                    <label for="headAdmin" style="padding-left:25px;">HeadAdmin</label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom:0px;">
                        <div class="col s12 center-align">
                            <button  style="margin-bottom:10px;" class="btn waves-effect waves-light" value="submit"
                            type="submit" name="uredi" style="margin-bottom:15px;">
                                SAVE
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                   <div class="row">
                        <div class="col s6">
                            <div class="input-field" >
                                <input style="margin:0px !important;" type="text" id="ime" name="ime" value="<?php echo $row['ime']; ?>">
                                <label for="ime">Name</label>
                                <span style="color:red; font-size:12px;"><?php echo $poruka ?></span>
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="input-field">
                                <input style="margin:0px !important;" type="text" id="prezime" name="prezime" value="<?php echo $row['prezime']; ?>">
                                <label for="prezime">Surname</label>
                                <span style="color:red; font-size:12px;"><?php echo $poruka1 ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="input-field">
                                <input style="margin:0px !important;" type="text" id="email" name="email" value="<?php echo $row['email']; ?>">
                                <label for="email">E-mail</label>
                                <span style="color:red; font-size:12px;"><?php echo $poruka2 ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="input-field">
                                <input style="margin:0px !important;" type="text" id="korisnicko_ime" name="korisnicko_ime" value="<?php echo $row['korisnicko_ime']; ?>">
                                <label for="korisnicko_ime">Username</label>
                                <span style="color:red; font-size:12px;"><?php echo $poruka3 ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
        </div>
        <div class="col s4">
            <form action="" method="POST">
            <div class="card">
                    <div class="card-content light-blue lighten-2" >
                        <span class="card-title white-text" style="font-size: 30px;">Change password</span>
                    </div>
                    <div class="card-action">
                        <div class="row">
                            <div class="col s12">
                                <div class="input-field">
                                        <i class="material-icons prefix">lock_open</i>
                                        <input type="password" id="staraLozinka" name="staraLozinka">
                                        <label for="staraLozinka">Old password</label>
                                        <span style="color:red; font-size:12px;"><?php echo $porukaLoz ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom:10px;">
                            <div class="col s12">
                                <div class="input-field">
                                        <i class="material-icons prefix">lock_outline</i>
                                        <input type="password" id="novaLozinka" name="novaLozinka">
                                        <label for="novaLozinka">New password</label>
                                </div>
                            </div>
                        </div>
                        <div class="input-field">
                                <button class="btn waves-effect waves-light center-align" value="submit"
                                type="submit" name="promjena">
                                    SAVE
                                </button>
                                <span style="color:green; font-size:12px;"><?php echo $porukaNova ?></span>
                            </div>
                    </div>
                </div>
            </form>
            
        </div>
        <?php }
        }
     }
      ?>
    </div>
        <!--JavaScript at end of body for optimized loading-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
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
        
    </body>
</html>
