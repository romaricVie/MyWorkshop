<?php
 require 'bdd.php';
   $req = $connexion -> query("SELECT psuedo, message, DATE_FORMAT(date,'%d/%m/%Y %Hh%imin%ss') AS date FROM tchat ORDER BY id ASC");
   
   while($donnee = $req -> fetch()){
    echo "<strong>".$donnee['psuedo'].":</strong> <br/>".$donnee['message']."<br/>  <span class='glyphicon glyphicon-time'></span> ".$donnee['date']."<br>";
   }

  $req ->closeCursor();
 ?>

 