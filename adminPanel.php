<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
      if(!isset($_SESSION['id_kor'])){ 
          header("Location: prijava.php");
      }   
  } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'templates/headerAdminPage.php' ?>
    <title>Admin panel</title>
<body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>

  <nav class="menu">
    <div class="nav-wrapper">
      <a href="adminPanel.php"><span class="agencija">Travel Agency</span></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#"><i class="material-icons" style="color:white !important;">notifications</i></a></li>
      </ul>
    </div>
  </nav>
  <div class="row">
    <div class="col s3 options mt">
      <div class="row">
        <div class="col s12">
          <p style="font-size:18px;" class="tekst"> <i class="medium material-icons inline-icon2">dashboard</i>
            <span style="font-size: 28px;">Admin panel</span></p>
          <p style="font-size:18px;" class="tekst">Dobrodošli</p>
          <p style="font-size:20px;" class="tekst"><?php echo $_SESSION['korisnik'] ?></p>
          <div class="divider teal lighten-2"></div>
        </div>
      </div>
      <?php
        if($_SESSION['tip'] == 'GlavniAdministrator'):
      ?>
      <ul>
        <li><a href="dodajAdmina.php"><i class="inline-icon material-icons" style="margin-right: 5px;">person_add</i>Dodaj admina</a></li>
        <li><a href="pregledAdmina.php"><i class="inline-icon material-icons" style="margin-right: 5px;">supervisor_account</i>Pregled admina</a></li>
        <li><a href="racunKorisnika.php"><i class="inline-icon material-icons"style="margin-right: 5px;">edit</i>Vaš račun</a></li>
        <div class="divider teal lighten-2" style="margin-bottom: 10px;"></div>
        <li><a href="dodajDestinaciju.php"><i class="inline-icon material-icons" style="margin-right: 5px;">add</i>Dodaj destinaciju</a></li>
        <li><a href="planAktivnosti.php"><i class="inline-icon material-icons" style="margin-right: 5px;">edit</i>Plan aktivnosti</a></li>
        <li><a href="urediAktivnosti.php"><i class="inline-icon material-icons" style="margin-right: 5px;">edit</i>Uredi plan aktivnosti</a></li>
        <li><a href="sveDestinacije.php"><i class="inline-icon material-icons" style="margin-right: 5px;">view_module</i>Pregled destinacija</a></li>
        <li><a href="pregledRezervacija.php"><i class="inline-icon material-icons" style="margin-right: 5px;">view_module</i>Pregled rezervacija</a></li>
        <div class="divider teal lighten-2" style="margin-bottom: 10px;"></div>
        <li><a href="napisiBlog.php"><i class="inline-icon material-icons">create</i>Napiši blog</a></li>
        <li><a href="pregledSvojihBlogova.php"><i class="inline-icon material-icons" style="margin-right: 5px;">view_module</i>Pregled svojih blogova</a></li>
        <div class="divider teal lighten-2" style="margin-bottom: 10px;"></div>
        <li><a href="pregledAktivnosti.php"><i class="inline-icon material-icons" style="margin-right: 5px;">view_module</i>Pregled aktivnosti</a></li>
        <div class="divider teal lighten-2" style="margin-bottom: 10px;"></div>
        <li><a href="index.php"><i class="inline-icon material-icons">home</i>Vrati na početnu</a></li>
        <li><a href="odjava.php"><i class="inline-icon material-icons" style="margin-right: 5px;">exit_to_app</i>Odjava</a></li>
      </ul>
      <?php endif ?>

      <?php
        if($_SESSION['tip'] == 'administrator'):
      ?>
      <ul>
        <li><a href="racunKorisnika.php"><i class="inline-icon material-icons"style="margin-right: 5px;">edit</i>Vaš račun</a></li>
        <div class="divider teal lighten-2" style="margin-bottom: 10px;"></div>
        <li><a href="dodajDestinaciju.php"><i class="inline-icon material-icons" style="margin-right: 5px;">add</i>Dodaj destinaciju</a></li>
        <li><a href="planAktivnosti.php"><i class="inline-icon material-icons" style="margin-right: 5px;">edit</i>Plan aktivnosti</a></li>
        <li><a href="sveDestinacije.php"><i class="inline-icon material-icons" style="margin-right: 5px;">view_module</i>Pregled destinacija</a></li>
        <li><a href="pregledRezervacija.php"><i class="inline-icon material-icons" style="margin-right: 5px;">view_module</i>Pregled rezervacija</a></li>
        <div class="divider teal lighten-2" style="margin-bottom: 10px;"></div>
        <li><a href="napisiBlog.php"><i class="inline-icon material-icons">create</i>Napiši blog</a></li>
        <li><a href="pregledSvojihBlogova.php"><i class="inline-icon material-icons" style="margin-right: 5px;">view_module</i>Pregled svojih blogova</a></li>
        <div class="divider teal lighten-2" style="margin-bottom: 10px;"></div>
        <li><a href="index.php"><i class="inline-icon material-icons">home</i>Vrati na početnu</a></li>
        <li><a href="odjava.php"><i class="inline-icon material-icons" style="margin-right: 5px;">exit_to_app</i>Odjava</a></li>
      </ul>
      <?php endif ?>
    </div>
  <script type="text/javascript">
    $('.filled-in').on('change', function() {
        $('.filled-in').not(this).prop('checked', false);
    });
</script>
</body>
</html>