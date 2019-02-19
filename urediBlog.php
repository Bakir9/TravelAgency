<?php   
include('db/konekcija.php');
if (session_status() == PHP_SESSION_NONE) {
 session_start();
}  
include('log.php');

    $id_bloga = $_GET['id'];
    $dbidkorisnika = $_SESSION['id_kor'];

    $query = "SELECT * FROM komentari WHERE id_bloga = $id_bloga AND id_korisnika = $dbidkorisnika";
    $query2 ="SELECT * FROM blog WHERE id_bloga = $id_bloga AND id_korisnika = $dbidkorisnika";
    $message = "";
    
    if(isset($_POST['urediBlog'])){
        $naziv = $_POST['naziv'];
        $opis = $_POST['opis'];
        $tekst = $_POST['tekst'];
        $Tekst = ltrim($tekst);
        $datum = date("d/m/Y");
        $vrijeme = date("h:i:sa");


        //Promjena slike
        $dir="images/";
        $file_name=$dir.basename($_FILES['img']['name']);
        $fileUpload=1;
        $imageType=pathinfo($file_name,PATHINFO_EXTENSION);
        $image_name = addslashes($_FILES['img']['name']);
        if(move_uploaded_file($_FILES['img']['tmp_name'], $file_name))
        {
        $querry="SELECT slika FROM blog WHERE id_bloga='$id_bloga'" or die(mysql_error());
        $result=mysqli_query($conn,$querry) or die(mysqli_error($conn));
        $row=mysqli_fetch_assoc($result) or die(mysqli_error($conn));
        $oldimage=$row['slika'];
        //brisanje stare slike iz baze podataka
        $deleter = "DELETE slika FROM blog WHERE slika = '$oldimage'";
            mysqli_query($conn,$deleter);
        
        $sql="UPDATE blog SET slika='$image_name' WHERE id_bloga='$id_bloga'";
        $result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        }
        //Kraj promjene slike

        $sql2 = "UPDATE blog SET naziv_bloga = '$naziv', kratki_opis = '$opis', text_bloga = '$Tekst', 
        datum_postavljanja = '$datum', vrijeme_postavljanja = '$vrijeme' WHERE id_bloga = $id_bloga";
         $res3 = mysqli_query($conn, $sql2);

         if($res3){
            $dbidkorisnika = $_SESSION['id_kor'];
            $korisnik = $_SESSION['korisnik'];
            $nazivAktivnosti = "Uređivanje bloga sa id $id_bloga";
            logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);
            $message = '<div id="message" class="col s12" >
                            <div class="row card-panel light-green accent-2">
                                <div class="green-text text-light-green darken-4 col s12">Uspješno ažuriran blog !</div>
                            </div>
                        </div>';
         }
    }

    if(isset($_POST['uredi'])){
        $id_komentara = $_POST['idKomentara'];
        $noviKomentar = $_POST['noviKomentar'];
        $datum = date("d/m/Y");
        $vrijeme = date("h:i:sa");

        $sql = "UPDATE komentari SET komentar = '$noviKomentar', datum = '$datum', vrijeme = '$vrijeme'
         WHERE id_komentara = $id_komentara";
         $res = mysqli_query($conn, $sql);

         if($res){
            $dbidkorisnika = $_SESSION['id_kor'];
            $korisnik = $_SESSION['korisnik'];
            $nazivAktivnosti = "Uređivanje komentara sa id $id_komentara";
            logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);
         }
    }

    if(isset($_POST['obrisi'])){
        $id_komentara = $_POST['idKomentara'];

        $sql = "DELETE FROM komentari WHERE id_komentara = $id_komentara";
         $res = mysqli_query($conn, $sql);
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
    <title>Uređivanje bloga</title>
</head>
<body>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script type="text/javascript" src="js/materialize.js"></script>
     
     <?php  include 'adminPanel.php'; ?> 

    <div class="col s8 z-depth-4" style="margin-left: 20px; margin-top: 10px; padding:0">
        <div class="row" style="background-color:rgb(99, 194, 226); margin-bottom: 10px;">
            <div class="col s12 left-align" style="height:80px;">
                <h4 style="margin-bottom:0;color:white; font-size:45px;">Edit your blog</h4>
            </div>    
        </div>
        <div class="row">
            <?php echo $message ?>
        </div>
        <?php 
            if( $res2 = mysqli_query($conn, $query2)){
                if(mysqli_num_rows($res2) > 0){
                    while ($row2 = mysqli_fetch_array($res2)){
                ?>
        <form action="" method="POST" enctype='multipart/form-data'>
            <div class="row">
                <div class="col s4">
                    <div class="input-field">
                        <i class="material-icons prefix">event</i>
                        <input  type="text" id="naziv" name="naziv" value="<?php echo $row2['naziv_bloga'] ?>">
                        <label for="naziv">Naziv bloga</label>
                    </div>
                </div>
                <div class="col s8">
                    <div class="input-field">
                        <i class="material-icons prefix">card_travel</i>
                        <input  type="text" id="opis" name="opis" value="<?php echo $row2['kratki_opis'] ?>">
                        <label for="opis">Kratki opis bloga</label>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col s12" style="padding:0; margin-left:13px;">
                    <img src="images/<?php echo $row2['slika']?>" width="875px" height="405px" alt="">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="textarea" class="materialize-textarea" name="tekst">
                        <?php echo ltrim($row2['text_bloga']) ?>
                    </textarea>
                    <label for="textarea2">Text</label>
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
                            <input class="file-path validate" type="text" value="<?php echo $row2['slika'] ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-field center-align">
                <button class="btn waves-effect waves-light" value="submit"
                    type="submit" name="urediBlog"  style="margin-bottom:15px;">
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
     <div class="row">
        <div class="col s4 push-s3">
            <h4 class="yourComment">Vaši komentari na ovaj blog</h4>
        </div>
     </div>
     
     <div class="row">
        <?php 
        if( $res = mysqli_query($conn, $query) or die(mysqli_error($conn))){
            if(mysqli_num_rows($res) > 0){
             while ($row = mysqli_fetch_array($res)){
         ?>
       <div class="col s6 push-s3 z-depth-2" style="margin-top: 20px; margin-left: 20px;">
            <form action="" method="POST">
                <div class="row" style="margin-bottom:0;">
                    <div class="col s3">
                        <p style="font-size: 14px; font-family: 'Raleway', sans-serif; ">
                            Date: <?php echo $row['datum']?>
                        </p>
                    </div>
                    <div class="col s3">
                        <p style="font-size: 14px; font-family: 'Raleway', sans-serif; ">
                            Time: <?php echo $row['vrijeme']?>
                        </p>
                    </div>
                    <div class="col s3">
                        <input type="hidden" name="idKomentara" value="<?php echo $row['id_komentara']?>">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">mode_edit</i>
                        <textarea id="textarea" name="noviKomentar" class="materialize-textarea"><?php echo $row['komentar'];?></textarea>
                        <label for="textarea2">Comment</label>
                    </div>
                </div>
                <div class="col s12 right-align">
                    <button class="btn waves-effect waves-light" value="dodaj"
                    type="dodaj" name="uredi"  style="margin-bottom:15px;">
                        EDIT
                    </button>
                    <button class="btn waves-effect waves-light" value="dodaj"
                    type="dodaj" name="obrisi"  style="margin-bottom:15px; background: red;">
                        DELETE
                    </button>
                </div>
                <div class="divider"></div>
            </form>
       </div>
       <?php }
   }
   }
   ?>
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