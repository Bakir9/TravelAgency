<?php
include('db/konekcija.php');
include('log.php');
session_start();
//logActivity
$dbidkorisnika = $_SESSION['id_kor'];
$korisnik = $_SESSION['korisnik'];
$nazivAktivnosti = "Odjava";
logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn);

session_unset();
session_destroy();
header("Location: index.php");
exit;
?>