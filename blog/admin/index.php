<?php
require('../../bdd.php');


?>

<!DOCTYPE html>
<html>
<head>
	<title>Page administrateur</title>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script src="assets/jquery/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet"type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
    <nav>
        <div id="sidebar" onclick="toggleSidebar()">
           <div class="toggle-btn">
              <span></span>
              <span></span>
              <span></span>
           </div>
           <ul>
                <li><a href="insert.php"><i class="fa fa-plus"> Ajouter un billet</i></a></li>
                <li><a href="contact.php"><i class="fa fa-phone"> Contacts</i></a></li>
                <li><a href="membre.php"><i class="fa fa-users"> Utilisateurs</i></a></li>
                <li><a href="../../user_online.php"><i class="fa fa-users"> Utilisateurs en Ligne</i></a></li>
            </ul>
        </div>
    </nav>
    
 <h1 style="text-align: center;">Bienvenue sur la page d'administration</h1>

<?php

      $req = $connexion -> query("SELECT id_billet, titre, contenu, DATE_FORMAT(date_creation,'%d/%m/%Y %Hh%imin%ss') AS date FROM billets ORDER BY id_billet DESC");
      $nombre = $req->rowcount();
      //echo "<p class='alert alert-success' style='text-align:center'>".$nombre." Billet(s)</p>";
echo  '<div class="container">
             <p class="alert alert-success"  style="text-align:center">'.$nombre.' Billet(s)</p>
    </div>';
 while ($donnee = $req->fetch()){
?>

 	<div class="news">
        <h3><?= $donnee['titre']; ?>
             <em>le <?= $donnee['date'] ?></em>
        </h3>
      <p>
        <?= nl2br($donnee['contenu'])?>
      
         <br/>
             <a href="modifier.php?id=<?=$donnee['id_billet']?>" class="btn btn-primary "role="button"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>
           <a href="delete.php?id=<?=$donnee['id_billet']?>"class="btn btn-danger "role="button"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>

         </p>
     </div>

 <?php

		}
		$req ->closeCursor();
		?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
