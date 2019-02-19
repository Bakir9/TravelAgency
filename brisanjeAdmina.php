<?php 
     include('db/konekcija.php');
     include('log.php');
     if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }  
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $sql2 = "DELETE FROM korisnici  WHERE id_korisnika = '$id'";
        $result = mysqli_query($conn, $sql2) or die("query no executed");

        if($result){
            
          header('Location: pregledAdmina.php');
          $dbidkorisnika = $_SESSION['id_kor'];
          $korisnik = $_SESSION['korisnik'];
          $nazivAktivnosti = "Brisanje admina";
          logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);
        } 
        else {
            "nije obrisano";
        }
      }
?>