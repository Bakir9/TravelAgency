<?php 
     include('db/konekcija.php');
     include('log.php');
     if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }  
    if(isset($_GET['id_bloga'])){
        $id = $_GET['id_bloga'];
        
        $sql2 = "DELETE FROM blog  WHERE id_bloga = '$id'";
        $result = mysqli_query($conn, $sql2) or die("query no executed");

        if($result){

          $query = "DELETE FROM komentari WHERE id_bloga = '$id'";
          $res = mysqli_query($conn, $query);
          
          header('Location: pregledSvojihBlogova.php');
          $dbidkorisnika = $_SESSION['id_kor'];
          $korisnik = $_SESSION['korisnik'];
          $nazivAktivnosti = "Brisanje bloga";
          logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);
        } 
      }
?>