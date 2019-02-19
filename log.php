<?php
    function logActivity($dbidkorisnika, $korisnik, $nazivAktivnosti, $conn){
        $datum = date("d/m/Y");
        $vrijeme = date("h:i:sa");

        $sql = "INSERT INTO aktivnosti VALUES ('0', '$dbidkorisnika', '$korisnik', '$nazivAktivnosti', 
        '$datum', '$vrijeme')";
        $query = mysqli_query($conn, $sql);

    }
?>