<?php 
   include('db/konekcija.php');
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }  
    $query = "SELECT * FROM korisnici where tip = 'administrator'"; 
    $res = mysqli_query($conn, $query);
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'templates/headerAdminPage.php' ?>
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
                        <span class="card-title white-text" style="font-size: 45px;">Admini</span>
                    </div>
                    <div class="card-action">
                        <table class="highlight">
                            <thead>
                              <tr>
                                  <th type="hidden"></th>
                                  <th>Name</th>
                                  <th>Surname</th>
                                  <th>E-mail</th>
                                  <th>Username</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            <?php 
                            if( $res = mysqli_query($conn, $query)){
                                if(mysqli_num_rows($res) > 0){
                                 while ($row = mysqli_fetch_array($res)){
                             ?>
                            <tbody>
                              <tr>
                                <td type="hidden" value="<?php echo $row['id_korisnika'] ?>"></td>
                                <td><?php echo $row['ime']; ?></td>
                                <td><?php echo $row['prezime']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['korisnicko_ime']; ?></td>
                                <td>
                                    <a href="uredjivanjeAdmina.php?id=<?= $row['id_korisnika'] ?>" class="btn waves-effect waves-light btn-small" style="background-color:green;">EDIT</a>
                                    <a href="brisanjeAdmina.php?id=<?= $row['id_korisnika'] ?>" class="btn waves-effect waves-light btn-small" name="brisanje" style="background-color:red;">DELETE</a>
                                </td>
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
