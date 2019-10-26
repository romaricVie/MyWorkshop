<?php
 require '../bdd.php';
  $req = $connexion -> query("SELECT psuedo, message, DATE_FORMAT(date,'%d/%m/%Y %Hh%imin%ss') AS date FROM tchat ORDER BY id ASC");
   
  while($donnee = $req -> fetch()){
    echo "<strong>".$donnee['psuedo'].":</strong> ".$donnee['message']."  heure ".$donnee['date']."<br>";
   }

  $req ->closeCursor();
 ?>