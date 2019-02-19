<?php 
   include('db/konekcija.php');
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
    include('log.php');
  }  
    $message = "";
   
    if(isset($_POST['dodaj'])){

        $naziv = $_POST['naziv'];
        $sazetak = $_POST['sazetak'];
        $tekst = $_POST['tekst'];
        $datum = date("d/m/Y");
        $vrijeme = date("h:i:sa");
        $dbidkorisnika = $_SESSION['id_kor'];
        $ime_korisnika = $_SESSION['korisnik'];

        /*Upload image*/ 
        $name = $_FILES['img']['name'];
        $target_dir = 'images/';
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        
        // Select file type (png, jpg,jpeg, gif)
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");
        
        if( in_array($imageFileType,$extensions_arr) ){
            
            $query = "INSERT INTO blog VALUES ('0','$dbidkorisnika','$ime_korisnika', '$naziv','$sazetak','$tekst','$datum',
            '$vrijeme', '$name')";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            // Upload file
            move_uploaded_file($_FILES['img']['tmp_name'],$target_dir.$name);
            
            if($result){
                $dbidkorisnika = $_SESSION['id_kor'];
                $korisnik = $_SESSION['korisnik'];
                $nazivAktivnosti = "Kreiran novi blog";
                logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);
                $message = '<div id="message" class="col s12" >
                                <div class="row card-panel light-green accent-2">
                                    <div class="green-text text-light-green darken-4 col s12">Uspješno kreiran novi blog !</div>
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
    <title>Napiši blog</title>
</head>
<body>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
      
    <?php  include 'adminPanel.php'; ?> 

    <div class="col s6 z-depth-4" style="margin-left: 20px; margin-top: 10px; padding:0;">
        <div class="row" style="background-color:rgb(99, 194, 226); margin-bottom:10px;">
            <div class="col s12 left-align" style="height:80px;">
                <h4 style="margin-bottom:0; color:white; font-size:45px;">Write blog</h4>
            </div> 
        </div>
        <div class="row" style="margin-bottom:0;">
            <?php echo $message ?>
        </div>
        <form action="napisiBlog.php"  method="POST" enctype='multipart/form-data'>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">event</i>
                    <input  type="text" id="naziv" name="naziv" >
                    <label for="naziv">Name blog</label>
                    <!--<span class="red-text"><?php echo $poruka ?></span>-->
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="textarea2" class="materialize-textarea" name="sazetak" data-length="160"></textarea>
                    <label for="textarea2">Abstract</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="textarea" class="materialize-textarea" name="tekst"></textarea>
                    <label for="textarea2">Text</label>
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
        $(document).ready(function() {
            $('input#input_text, textarea#textarea2').characterCounter();
        });

        $(document).ready(function () {
        setTimeout(function () {
            $('#message').hide();
        }, 3000);
        });
    </script>
</body>
</html>