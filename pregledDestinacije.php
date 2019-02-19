<?php 
     include('db/konekcija.php');
     include('log.php');
     if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }  

    $id_destinacije = $_GET['id_destinacije'];

    $sql2 = "SELECT * FROM destinacije WHERE id = $id_destinacije";
    $result = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result);
    

    if(isset($_POST['urediDestinaciju'])){
        $naziv = $_POST['naziv'];
        $cijena = $_POST['cijena'];
        $let = $_POST['let'];
        $datum = $_POST['datum'];
        $opis = $_POST['opis'];

        //Promjena slike
        $dir="images/";
        $file_name=$dir.basename($_FILES['img']['name']);
        $fileUpload=1;
        $imageType=pathinfo($file_name,PATHINFO_EXTENSION);
        $image_name = addslashes($_FILES['img']['name']);
        if(move_uploaded_file($_FILES['img']['tmp_name'], $file_name))
        {
        $querry="SELECT slika FROM destinacije WHERE id = $id_destinacije" or die(mysql_error());
        $result=mysqli_query($conn,$querry) or die(mysqli_error($conn));
        $row=mysqli_fetch_assoc($result) or die(mysqli_error($conn));
        $oldimage=$row['slika'];
        //brisanje stare slike iz baze podataka
        $deleter = "DELETE slika FROM destinacije WHERE slika = '$oldimage'";
            mysqli_query($conn, $deleter);
        
        $sql="UPDATE destinacije SET slika='$image_name' WHERE id = '$id_destinacije'";
        $result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        }
        //Kraj promjene slike

        $query = "UPDATE destinacije SET naziv_destinacije = '$naziv', cijena_destinacije = '$cijena', 
        datum_destinacije = '$datum', let_destinacije = '$let', Opis = '$opis' WHERE id = $id_destinacije";
        $rezultat = mysqli_query($conn, $query);
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
<title>Pregled destinacija</title>
<body>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
      
    <?php  include 'adminPanel.php'; ?> 

    <div class="col s8">
        <div class="card ">
            <div class="card-content light-blue lighten-2" >
                <span class="card-title white-text" style="font-size: 45px;"><?php echo $row2['naziv_destinacije'] ?></span>
            </div>
            <div class="card-action">
           <?php if( $result = mysqli_query($conn, $sql2)){
                if(mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_array($result)){
                ?>
                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col s4">
                            <div class="input-field">
                                <i class="material-icons prefix">event</i>
                                <input  type="text" id="naziv" name="naziv" value="<?php echo $row['naziv_destinacije'] ?>">
                                <label for="naziv">Naziv destinacije</label>
                            </div>
                        </div>
                        <div class="col s4">
                            <div class="input-field">
                                <i class="material-icons prefix">card_travel</i>
                                <input disabled type="text" id="dani" name="dani" value="<?php echo $row['brojDanaPansiona'] ?>">
                                <label for="dani">Broj dana</label>
                            </div>
                        </div>
                        <div class="col s4">
                            <div class="input-field">
                                <i class="material-icons prefix">card_travel</i>
                                <input type="text" id="cijena" name="cijena" value="<?php echo $row['cijena_destinacije'] ?>">
                                <label for="cijena">Cijena</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s4">
                            <div class="input-field">
                                <i class="material-icons prefix">event</i>
                                <input type="text" id="let" name="let" value="<?php echo $row['let_destinacije'] ?>">
                                <label for="let">Let</label>
                            </div>
                        </div>
                        <div class="col s8">
                            <div class="input-field">
                                <i class="material-icons prefix">card_travel</i>
                                <input  type="text" name="datum" value="<?php echo $row['datum_destinacije'] ?>">
                                <label for="datum">Datum polaska</label>
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col s12" style="padding:0;">
                            <img src="images/<?php echo $row['slika'] ?>" width="825px" height="405px" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">mode_edit</i>
                            <textarea id="textarea" class="materialize-textarea" name="opis">
                                    <?php echo $row['Opis'] ?>
                            </textarea>
                            <label for="textarea2">Description</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file" name="img" >
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-field center-align">
                        <button class="btn waves-effect waves-light" value="submit"
                            type="submit" name="urediDestinaciju"  style="margin-bottom:15px;">
                            EDIT
                        </button>
                    </div>
                </form>
                    <?php
                     }
                    }
                  }
              ?>
            </div>
        </div>
    </div>

        <!--JavaScript at end of body for optimized loading-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <!-- Sweet alert -->
        <script src="js/sweetalert2.all.min.js"></script>
        <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
        <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
        <script src="js/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="css/sweetalert2.min.css">
        <link rel="stylesheet" href="css/sweetalert2.css">
        <script>
            function uspjeh(){
            Swal(
                'Obrisali ste admina!',
                'success'
            );}
        </script>
</body>
</html>