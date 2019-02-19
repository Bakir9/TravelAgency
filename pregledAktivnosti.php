<?php 
   include('db/konekcija.php');
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }  
    $dbidkorisnika = $_SESSION['id_kor'];
    $query = "SELECT * FROM aktivnosti where id_korisnika != '$dbidkorisnika'"; 
    $res = mysqli_query($conn, $query);
    

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
        <div class="col s7">
            <div class="card ">
                    <div class="card-content light-blue lighten-2" >
                        <span class="card-title white-text" style="font-size: 45px;">Review activities</span>
                    </div>
                    <div class="card-action">
                        <table class="highlight">
                            <thead>
                              <tr>
                                  <th type="hidden"></th>
                                  <th>ID user</th>
                                  <th>User</th>
                                  <th>Name of activity</th>
                                  <th>Date</th>
                                  <th>Time</th>
                              </tr>
                            </thead>
                            <?php 
                            if( $res = mysqli_query($conn, $query)){
                                if(mysqli_num_rows($res) > 0){
                                 while ($row = mysqli_fetch_array($res)){
                             ?>
                            <tbody>
                              <tr>
                                <td type="hidden" value="<?php echo $row['id'] ?>"></td>
                                <td><?php echo $row['id_korisnika']; ?></td>
                                <td><?php echo $row['korisnik']; ?></td>
                                <td><?php echo $row['naziv_aktivnosti']; ?></td>
                                <td><?php echo $row['datum']; ?></td>
                                <td><?php echo $row['vrijeme']; ?></td>
                              </tr>
                            </tbody>
                            <?php }
        }
     }
      ?>
                          </table>
                    </div>
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
