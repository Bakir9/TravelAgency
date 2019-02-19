<?php 
	 include('db/konekcija.php');
	 if (session_status() == PHP_SESSION_NONE) {
	  session_start();
	}  
      $id = $_GET['id'];
      $sql = "SELECT * FROM blog WHERE id_bloga = $id";
      $res = mysqli_query($conn, $sql);

    //pregled bloga
    if(isset($_POST['dodaj'])){
        $komentar = $_POST['komentar'];
        $id = $_GET['id'];
        $dbidkorisnika = $_SESSION['id_kor'];
        $ime_korisnika =  $_SESSION['korisnik'];
        $datum = date("d/m/Y");
        $vrijeme = date("h:i:sa");

        $sql = "INSERT INTO komentari VALUES ('0', '$id', '$dbidkorisnika', '$ime_korisnika',
        '$komentar', '$datum', '$vrijeme')";
        $result = mysqli_query($conn, $sql)  or die(mysqli_error($conn));

        if($result){
            header("Location:blogPregled.php?id=" .$id);
        }
    }

    $upit = "SELECT * FROM komentari WHERE id_bloga = $id";
    $rez = mysqli_query($conn, $upit) or die(mysqli_error($conn));
     
    $query = "SELECT COUNT(id_bloga) AS broj FROM komentari WHERE id_bloga = $id";
    $komentari = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $numberOfRows = mysqli_fetch_assoc($komentari);
    $broj = $numberOfRows['broj'];
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
    <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/animate.css"  media="screen,projection"/>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton|Staatliches" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Paytone+One" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Sweet alert -->
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <title>Blog</title>
</head>
<body>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
    

    <?php  include 'templates/header.php'; ?> 

    <div class="row">
        <div class="col s12 center-align" style="padding:0;">
            <p class="blog">BLOG</p>
        </div>
    </div>
    <div class="row">
        <?php  include 'sideMenu.php'; ?> 
        
            
        <div class="col s8" style="padding:0; border-bottom: 1px solid #0277bd;">
            <?php 
                if(mysqli_num_rows($res) > 0){
                    while( $row = mysqli_fetch_array($res)){
                        ?>
            <img src="images/<?php echo $row['slika']?>" width="900px" height="400px" alt="">
            <p class="blogTitle"><?php echo $row['naziv_bloga']?></p>
            <div class="row">
                <div class="col s2">
                    <p class="blogDatum"><?php echo $row['datum_postavljanja'] ?></p>
                </div>
                <div class="col s6" style="margin-top:8px;">
                    <p class="blogPosted">Posted by <span class="posted"> <?php echo $row['ime_korisnika']?></span></p>
                </div>
            </div>
            <div class="row" >
                <div class="col s12">
                    <p class="blogText" style="margin-bottom:15px;">
                        <?php echo $row['text_bloga'] ?>
                    </p>
                            <?php  
                        }
                    }
                ?>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <h5 style="font-family: 'Raleway', sans-serif;"><?php echo $broj ?> Comment</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s6 z-depth-2">
                    <?php 
                        if(mysqli_num_rows($rez) > 0){
                            while( $row = mysqli_fetch_array($rez)){
                                ?>
                    <form action="" method="POST">
                        <div class="row" style="margin-bottom:0;">
                            <div class="col s4">
                                <div class="chip" style="width:120px !important; margin: 10px 0 10px 10px;">
                                    <img src="images/bali.jpg" alt="Contact Person">
                                    <?php echo $row['naziv_korisnika'] ?>
                                  </div>
                            </div>
                            <div class="col s4">
                                <p style="font-size: 14px; font-family: 'Raleway', sans-serif; ">Date: <?php echo $row['datum'] ?></p>
                            </div>
                            <div class="col s4">
                                <p style="font-size: 14px; font-family: 'Raleway', sans-serif; ">Time: <?php echo $row['vrijeme'] ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <p style="font-size: 14px; font-family: 'Raleway', sans-serif; ">
                                <?php echo $row['komentar'] ?>
                                </p>
                            </div>
                        </div>
                    </form>
                    <div class="divider"></div>
                            <?php  
                        }
                    }
                ?>
                </div>
            </div>
            <div class="row" style="margin-bottom:10px;">
                <div class="col s2">
                    <p onclick="toogle_div_fun('sekcijaKomentar')" style="margin-bottom:0;" class="comment"><i class="inline-icon material-icons">message</i>Add comment</p> 
                </div>
            </div>
            <div class="row" style="margin-bottom: 0; display:none;" id="sekcijaKomentar" >
            <input type="hidden" name="id" value="<?php echo $id ?>">
                <form action="" method="POST">
                    <div class="input-field col s7" style="margin-top: 0px; margin-bottom:0px; ">
                        <textarea style="margin-bottom:0;" id="textarea1" name="komentar" class="materialize-textarea"></textarea>
                        <label for="textarea1">Your Comment</label>
                    </div>
                    <div class="col s2 valign-wrapper">
                        <button class="btn waves-effect waves-light" value="dodaj"
                        type="dodaj" name="dodaj"  style="margin-bottom:15px;">
                            Dodaj
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php  include 'templates/footer.php'; ?> 
	<!---->
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript">
        function toogle_div_fun(id){
            var divelement = document.getElementById(id);
            if(divelement.style.display == 'none')
            divelement.style.display = 'block';
            
            else 
                divelement.style.display = 'none';
        }
    </script>
</body>
</html>