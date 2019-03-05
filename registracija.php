<?php 
    include('db/konekcija.php');
    include('log.php');
    $message ="";
    if(isset($_POST['registracija'])){
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $korime = $_POST['korisnicko_ime'];
        $mail = $_POST['mail'];
        $sifra = $_POST['sifra'];

        $sql = "INSERT INTO korisnici VALUES ('0', '$ime', '$prezime', '$mail', '$korime', '$sifra', 'korisnik')";
        $res = mysqli_query($conn, $sql);

        if($res){
            $message = '<div id="message" class="col s12">
                            <div class="row card-panel light-green accent-2">
                                <div class="green-text text-light-green darken-4 col s12">Uspješna registracija !</div>
                            </div>
                        </div>';
            header('Location: prijava.php');
        }
    }
?>
<!DOCTYPE html>
  <html>
    <head>
    <?php include 'templates/headerPage.php'; ?>
    <title>Registration</title>

    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>

    <div class="row prijava">
        <div class="col s4 offset-s4">
            <div class="row">
                <div class="col s12">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="card col s12" style="padding:0;">
                                <div class="card-action red white-text">
                                    <h3>Registration Form</h3>
                                </div>
                                <div class="card-content">
                                    <div class="input-field col s6">
                                        <label for="First Name">First name</label>
                                        <input type="text" id="first name" name="ime">
                                    </div>
                                    <div class="input-field col s6">
                                        <label for="Last Name">Last Name</label>
                                        <input type="text" id="Last Name" name="prezime">
                                    </div>
                                    <div class="input-field col s12">
                                        <label for="E-mail">E-mail</label>
                                        <input type="text" id="e-mail" name="mail">
                                    </div>  
                                    <div class="input-field col s6">
                                        <label for="korisnicko_ime">Username</label>
                                        <input type="text" id="korisnicko_ime" name="korisnicko_ime">
                                    </div> 
                                    <div class="input-field col s6">
                                        <label for="sifra">Password</label>
                                        <input type="password" id="sifra" name="sifra">
                                    </div>
                                    <div class="col s12 center-align input-field" style="margin-bottom: 20px;">
                                        <button class="btn-large red" value="submit"
                                        type="submit" name="registracija">Register</button>
                                        <a href="index.php" style="margin-left:20px;">Back to home</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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