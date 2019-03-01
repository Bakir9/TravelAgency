<?php 
   include('db/konekcija.php');
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }  
    $query = "SELECT * FROM rezervacije "; 
    $res = mysqli_query($conn, $query);
    
    if(isset($_POST['potvrda'])){
        $id_rezervacije = $_POST['potvrda'];
        $sql = "UPDATE rezervacije SET status = 'Potvrdjena' WHERE id_rezervacije = '$id_rezervacije'";
        $rezultat = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }

    if(isset($_POST['ponisti'])){
        $id_rezervacije = $_POST['ponisti'];
        $sql = "UPDATE rezervacije SET status = 'Ponistena' WHERE id_rezervacije = '$id_rezervacije'";
        $rezultat = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
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
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Sweet alert -->
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    </head>
    <title>Pregled rezervacija</title>
</head>
<body>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
     
    <?php  include 'adminPanel.php'; ?> 
    
    <div class="col s8">
        <div class="card ">
            <label style="font-size:16px;">Potvrđene / Na čekanju</label>
                <select>
                    <option value="Potvrdjena">Izaberi opciju</option>
                    <option value="Potvrdjena">Potvrdjena</option>
                    <option value="Na cekanju">Na cekanju</option>
                </select>
            <div class="card-content light-blue lighten-2" >
                <span class="card-title white-text" style="font-size: 45px;">All reservation</span>
            </div>
                <div class="card-action">
                    <table class="highlight">
                        <thead>
                        <tr>
                            <th type="hidden"></th>
                            <th>ID Destination</th>
                            <th>Passengers</th>
                            <th>Question</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <?php 
                        if( $res = mysqli_query($conn, $query)){
                            if(mysqli_num_rows($res) > 0){
                            while ($rezervacija = mysqli_fetch_array($res)){
                        ?>
                        <tbody>
                            <form action="" method="POST">
                                <tr>
                                    <td type="hidden" name="id" value="<?php echo $rezervacija['id_rezervacije'] ?>"></td>
                                    <td style="font-family: 'Oswald', sans-serif !important; font-size: 18px;"><?php echo $rezervacija['id_destinacije']; ?></td>
                                    <td style="font-family: 'Oswald', sans-serif !important;"><?php echo $rezervacija['broj_putnika']; ?></td>
                                    <td style="font-family: 'Oswald', sans-serif !important;"><?php echo $rezervacija['pitanja']; ?></td>
                                    <td style="font-family: 'Oswald', sans-serif !important;"><?php echo $rezervacija['status']; ?></td>
                                    <td>
                                    <button class="btn green" value="<?php echo $rezervacija['id_rezervacije'] ?>" name="potvrda">CONFIRM</button>
                                    <button class="btn red" value="<?php echo $rezervacija['id_rezervacije'] ?>"  name="ponisti">CANCEL</button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                        <?php }
                        }
                    }
                ?>
                    </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var options = {}
            var instances = M.FormSelect.init(elems, options);
        });
    </script>
</body>
</html>