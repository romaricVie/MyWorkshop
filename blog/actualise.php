<?php
session_start();
 require("../bdd.php");
 
  // requete pour afficher les commentaires
 

  
    $req = $connexion -> prepare("SELECT id_commentaire,  auteur, DATE_FORMAT(date_commentaire, '%d/%m/%Y %Hh%imin%ss') AS date, commentaire FROM commentaires WHERE id_billet = ? ORDER BY date");

    $req ->execute(array($_SESSION['id']));

    while ($donnee = $req -> fetch()){
      ?> 

      <div class="container" >
             <p><strong><?= $donnee['auteur']?></strong></p>
              <p>
                  <?= $donnee['commentaire']?>
               </p>
          <p><span class="glyphicon glyphicon-time"></span>  <?= $donnee['date']?></p>
        
            
      </div>
      
      <?php
    }

    $req->closeCursor();


?>