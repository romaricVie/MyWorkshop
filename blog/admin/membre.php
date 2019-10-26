<?php
require('../../bdd.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Membres</title>
    <meta charset="utf-8">
     <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet"type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
    
     <h1>Liste des membres</h1>
     <table class="table table-striped table-bordered">
     	 <thead>
     	 	 <tr>
     	 		 <th>Nom & Prenoms</th>
                 <th>Sexe</th>
     	 		 <th>Email</th>
                 <th>Pays</th>
     	 		 <th colspan="2">Action</th>
     	 	 </tr>
     	 </thead>
     	 <tbody>
     	 	<?php
             $req = $connexion -> query(" SELECT * FROM membres");
             $nombre = $req -> rowCount();
            echo '<p class="alert alert-success">Nous avons '.$nombre.' membres sur notre plateforme</p>';
             while($donnee = $req -> fetch()){?>
     	 	  <tr>
     	 	  	<td><?=$donnee['nom'].' '.$donnee['prenoms']?></td>
     	 	  	<td><?=$donnee['sexe']?></td>
                <td><?=$donnee['email']?></td>
                <td><?=$donnee['pays']?></td>
     	 	  	<td><a href="deleted.php?id=<?=$donnee['id']?>" class="btn btn-danger "><span class="glyphicon glyphicon-remove"></span>Supprime le Compte</a></td>
                <td><a href="index.php" class="btn btn-primary"><span class ="glyphicon glyphicon-home"></span> Accueil </a></th>
     	 	  </tr>
     	 	  <?php

     	 	    }
     	 	      $req -> closeCursor();
     	 	?>
     	 </tbody>
     </table>
 
</body>
</html>