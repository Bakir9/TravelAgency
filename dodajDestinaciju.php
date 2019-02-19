<?php 
    include('db/konekcija.php');
    session_start();
    include('log.php');
    $message = " ";
    $message = '<div id="message" class="col s12" style="height: 50px;">
        <div class="row card-panel light-green accent-2">
            <div class="green-text text-light-green darken-4 col s12">Destinacija uspješno dodana !</div>
        </div>
    </div>';
  if(isset($_POST['dodaj'])){
        
        $naziv_destinacije = $_POST['naziv'];
        $brojDanaPansiona = $_POST['dani'];
        $cijena_destinacije = $_POST['cijena'];
        $datum_destinacije = $_POST['datum'];
        $let_destinacije = $_POST['let'];
        $opis = $_POST['opis'];
        /*Upload image*/ 
        $name = $_FILES['img']['name'];
        $target_dir = 'images/';
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        
        // Select file type (png, jpg,jpeg, gif)
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");
        
        if( in_array($imageFileType,$extensions_arr) ){
            
            $query = "INSERT INTO destinacije VALUES ('0','$naziv_destinacije','$brojDanaPansiona','$cijena_destinacije','$datum_destinacije','$let_destinacije','$name','$opis')";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            // Upload file
            move_uploaded_file($_FILES['img']['tmp_name'],$target_dir.$name);
            
            if($result){
                $dbidkorisnika = $_SESSION['id_kor'];
                $korisnik = $_SESSION['korisnik'];
                $nazivAktivnosti = "Dodana destinacija";
                logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);
                $message = '<div id="message" class="col s12" style="height: 50px;">
                        <div class="row card-panel light-green accent-2">
                            <div class="green-text text-light-green darken-4 col s12">Destinacija uspješno dodana !</div>
                        </div>
                    </div>';
            }
    
        }
    }

    $upit = "SELECT * FROM destinacije ORDER BY id DESC LIMIT 1";
    $rez = mysqli_query($conn, $upit);
    $row = mysqli_fetch_array($rez);
    $idDestinacije = $row['id'];
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
    <title>Dodaj Destinaciju</title>
<body>
     <!--Import jQuery before materialize.js-->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script type="text/javascript" src="js/materialize.js"></script>
     
     <?php  include 'adminPanel.php'; ?> 

     <div class="col s6 z-depth-4" style="background-color:white; margin-left: 20px; margin-top: 10px;  padding:0;">
        <div class="row" style="background-color:rgb(99, 194, 226); margin-bottom:10px;">
            <div class="col s12 left-align" style="height:80px;">
                <h4 style="margin-bottom:0; color:white; font-size:45px;">Add destination</h4>
            </div>
        </div>
        <div class="row" style="margin-bottom:17px;">
            <?php echo $message ?>
        </div>
        <form action="dodajDestinaciju.php"  method="POST" enctype='multipart/form-data'>
            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        <i class="material-icons prefix">event</i>
                        <input  type="text" id="naziv" name="naziv" >
                        <label for="naziv">Naziv destinacije</label>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field">
                        <i class="material-icons prefix">all_inclusive</i>
                        <input  type="text" id="cijena" name="cijena" >
                        <label for="prezime">Cijena (KM)</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        <i class="material-icons prefix">card_travel</i>
                        <input  type="text" id="dani" name="dani">
                        <label for="dani">Dan / Pansion</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        <i class="material-icons prefix">date_range</i>
                        <input  type="text" id="datum" name="datum" >
                        <label for="datum">Datum</label>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field">
                        <i class="material-icons prefix">flight_takeoff</i>
                        <input  type="text" id="let" name="let" >
                        <label for="let">Let</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        <i class="material-icons prefix">description</i>
                        <textarea  style="margin-bottom:0;" name="opis" class="materialize-textarea"></textarea>
                        <label for="opis">Description</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            <input type="file" name="img">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
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
     <script>
        $(document).ready(function () {
        setTimeout(function () {
            $('#message').hide();
        }, 3000);
        });
    </script>
</body>
</html> 