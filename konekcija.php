<?php 
  try {
     $db = new PDO("mysql:localhost=host;dbname=agencija", "root", "");
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e ) {
        echo "Error: " . $e->getMessage();
  }
  
 ?>