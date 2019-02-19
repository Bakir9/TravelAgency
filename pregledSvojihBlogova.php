<?php 
   include('db/konekcija.php');
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }  
  $dbidkorisnika = $_SESSION['id_kor'];
    $query = "SELECT * FROM blog WHERE id_korisnika = $dbidkorisnika "; 
    $res = mysqli_query($conn, $query);
    
    if(isset($_POST['brisanje'])){
        $id_bloga = $_POST['id_bloga'];

        $sql = "DELETE FROM blog WHERE id_bloga = $id_bloga";
         $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
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

    <!--<div class="row">-->
        <div class="col s9">
            <div class="card ">
                    <div class="card-content light-blue lighten-2" >
                        <span class="card-title white-text" style="font-size: 45px;">Blog</span>
                    </div>
                    <?php 
                        if( $res = mysqli_query($conn, $query)){
                            if(mysqli_num_rows($res) > 0){
                                while ($row = mysqli_fetch_array($res)){
                        ?>
                <form action="" method="POST">
                    <div class="card-action">
                        <div class="row" style="margin-bottom:0px;">
                            <div class="col s2">
                                <h5 style="font-size: 18px; font-family: 'Raleway', sans-serif; "> <b>Naziv bloga:</b></h5>
                                <input type="hidden" name="id_bloga" value="<?php echo $row['id_bloga']?>">
                                <div class="row">
                                    <div class="col s12" style="padding-left: 0;">
                                        <p style="margin-top: 0px; margin-bottom: 0px; font-size: 18px;"><?php echo $row['naziv_bloga']; ?></p> 
                                    </div>
                                </div>
                            </div>
                            <div class="col s6">
                                <h5 style="font-size: 18px;"><b>Kratki opis:</b></h5>
                                <div class="row">
                                    <div class="col s12">
                                        <p style="margin-top: 0px; margin-bottom: 0px;"><?php echo $row['kratki_opis']; ?></p> 
                                    </div>
                                </div>
                            </div>
                            <div class="col s4 right-align" style="margin-top: 35px;">
                                <a href="urediBlog.php?id=<?= $row['id_bloga'] ?>" class="btn waves-effect waves-light btn-small" style="background-color:green;">EDIT</a>
                                <a href="brisanjeBloga.php?id_bloga=<?= $row['id_bloga'] ?>" class="btn waves-effect waves-light btn-small" name="brisanje" style="background-color:red;">Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                </form>
                                <?php
                            }
                         }
                     }
                ?>
            </div>
        </div>
   <!-- </div>-->
    
        
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
        <script>
            function uspjeh(){
            Swal(
                'Obrisali ste admina!',
                'success'
            );}
        </script>
    </body>
</html>
