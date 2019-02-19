<?php 
   include('db/konekcija.php');
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }  
    $query = "SELECT * FROM destinacije "; 
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
    <title>Sve destinacije</title>
</head>
<body>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
     
    <?php  include 'adminPanel.php'; ?> 
    
    <div class="col s7">
        <div class="card ">
                <div class="card-content light-blue lighten-2" >
                    <span class="card-title white-text" style="font-size: 45px;">All destination</span>
                </div>
                <div class="card-action">
                    <table class="highlight">
                        <thead>
                          <tr>
                              <th type="hidden"></th>
                              <th>Name</th>
                              <th>Day / Pansion</th>
                              <th>Price</th>
                              <th>Flight from</th>
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
                            <td type="hidden" value="<?php echo $row['id'] ?>"></td>
                            <td style="font-family: 'Oswald', sans-serif !important; font-size: 18px;"><?php echo $row['naziv_destinacije']; ?></td>
                            <td style="font-family: 'Oswald', sans-serif !important;"><?php echo $row['brojDanaPansiona']; ?></td>
                            <td style="font-family: 'Oswald', sans-serif !important;"><?php echo $row['cijena_destinacije']; ?> KM</td>
                            <td style="font-family: 'Oswald', sans-serif !important;"><?php echo $row['let_destinacije']; ?></td>
                            <td>
                                <a href="pregledDestinacije.php?id_destinacije=<?= $row['id']?>" class="btn waves-effect waves-light btn-small" style="background-color:green;">EDIT</a>
                                <a href="brisanjeDestinacije.php?id_destinacije=<?= $row['id'] ?>" class="btn waves-effect waves-light btn-small" name="brisanje" style="background-color:red;">DELETE</a>
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
</body>
</html>