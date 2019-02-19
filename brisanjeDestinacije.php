<?php 
     include('db/konekcija.php');
     include('log.php');
     if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }  
    if(isset($_GET['id_destinacije'])){
        $id = $_GET['id_destinacije'];
        
        $sql2 = "DELETE FROM destinacije  WHERE id = '$id'";
        $result = mysqli_query($conn, $sql2) or die("query no executed");

        if($result){
            
          $query = "DELETE FROM dani WHERE id_destinacije = $id";
          $res = mysqli_query($conn, $query);

          header('Location: sveDestinacije.php');
          $dbidkorisnika = $_SESSION['id_kor'];
          $korisnik = $_SESSION['korisnik'];
          $nazivAktivnosti = "Brisanje destinacije sa $id";
          logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);
        } 
        else {
            "nije obrisano";
        }
      }
?>