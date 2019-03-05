<?php 
    include('db/konekcija.php');
    session_start();
    include('log.php');

    $query = "SELECT * FROM destinacije";
    $res = mysqli_query($conn, $query);
    $destinationSelected = false;
    $selectedValue = "0";
    $selectText = "Choose destination";
    $b=0;
    if(isset($_POST['dodajID'])){
        $idDestinacije = $_POST['destination'];
        $_SESSION['id_destinacije'] = $idDestinacije;
        $selectedValue = $_SESSION['id_destinacije'];

        $upit = "SELECT * FROM destinacije WHERE id = $idDestinacije";
        $rez = mysqli_query($conn, $upit);
        $row = mysqli_fetch_array($rez);

        $b =(int)$row['brojDanaPansiona'];
        $selectText = $row['naziv_destinacije'];
    }
        if(isset($_POST['dodajOpis'])){
            $selectedValue = $_SESSION['id_destinacije'];
            $upit = "SELECT * FROM destinacije WHERE id = $selectedValue";
            $rez = mysqli_query($conn, $upit);
            $row = mysqli_fetch_array($rez);
            $k =(int)$row['brojDanaPansiona'];

            $dan = $_POST['dan'];
            $opisDana = $_POST['opisDana'];
        
            $brojDana = array();
            $opis = array();
    
        for ($i = 0; $i < $k; $i++){
            $brojDana[] = $_POST['dan'][$i];
            $opis[] = $_POST['opisDana'][$i]; 
    }
   
    for($i=0; $i < $k; $i++){
        $br = mysqli_real_escape_string($conn, $brojDana[$i]);
        $op = mysqli_real_escape_string($conn, $opis[$i]);

        mysqli_query($conn, "INSERT INTO dani VALUES ('0', '$selectedValue', '$br', '$op')") or die(mysqli_error($conn));
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
    

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Sweet alert -->
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
</head>
    <title>Plan aktivnosti</title>
<body>
     <!--Import jQuery before materialize.js-->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script type="text/javascript" src="js/materialize.js"></script>
     
     <?php  include 'adminPanel.php'; ?> 

     <div class="row">
        <form action="" method="POST">
            <div class="input-field col s5">
                <select class="icons" name="destination">
                    <option value="<?php echo $selectedValue ?>"disabled selected><?php echo $selectText ?></option>
                   
                    <?php if(mysqli_num_rows($res) > 0){
                        while ($row = mysqli_fetch_array($res)){
                    ?>
                        <option value="<?php echo $row['id']?>" name="id" data-icon="images/<?php echo $row['slika'] ?>">
                            <?php echo $row['naziv_destinacije']?>
                        </option>
                    <?php  
                        } 
                    }  
                    ?>
                </select>
                <label>Choose your destination</label>
            </div>
            <div class="input-field col s3 center-align">
                <button class="btn waves-effect waves-light" value="submit"
                    type="submit" name="dodajID"  style="margin-bottom:15px;">
                    Submit
                </button>
            </div>
        </form>
        <div class="row">
            <div class="col s8">
                <div class="row">
                    <div class="col s12">
                    <?php if($b>0){ ?>
                        <form  id="formaZaopis" action="" method="POST" class="col s12 z-depth-4">
                        <?php for ($x=1; $x <= (int)$b; $x++){ ?>
                            <div class="row">
                                <div class="col s12">
                                    <div class="row">
                                        <div class="input-field col s3">
                                            <i class="material-icons prefix">date_range</i>
                                            <input placeholder="Day" id="dan" type="text" name="dan[]">
                                            <label for="first_name">Day</label>
                                        </div>
                                        <div class="input-field col s9" style="margin-top: 0px; margin-bottom:0px; ">
                                            <i class="material-icons prefix">edit</i>
                                            <textarea style="margin-bottom:0;" id="textarea1" name="opisDana[]" class="materialize-textarea"></textarea>
                                            <label for="textarea1">Description</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider blue" style="margin-bottom: 20px;"></div>
                            <?php } ?>
                            <div class="row">
                                <div class="input-field col s12 center-align">
                                    <button class="btn waves-effect waves-light"
                                        type="submit" name="dodajOpis"  style="margin-bottom:15px;">
                                        Dodaj
                                        <i class="material-icons right">send</i>
                                    </button>
                                    <div class="divider blue"></div>
                                </div>
                            </div>
                        </form>
                        <?php }?>
                    </div>
                </div>
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
    <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html> 